<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Mail\HobbyCreated;
use App\Mail\HobbyDeleted;
use App\Mail\HobbyUpdated;
use Exception;
use Mail;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class HobbyController extends Controller
{
    /**
     * Prevent unauthorized access
     * 
     * @return void
     */
    public function __construct(){
        
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hobbies = Hobby::where('user_id', \Auth::user()->id)->get();

        return view('home', compact('hobbies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
    		'name' => 'required|string|max:30',
    		'description'=> 'required|string'
        ]);
        
        $hobby = Hobby::firstOrCreate([
        'name' => request('name')], 
        ['name' => request('name'), 
        'description' => request('description'),
        'user_id' => \Auth::user()->id
        ]);
        $hobby->save();

        if($hobby->wasRecentlyCreated){
            $firstName = \Auth::user()->firstName;

            $smsMessage = 'Hello '.$firstName.', you just added a new hobby '.request('name').' to your list.';

            try {
                Mail::to(\Auth::user()->email)
                ->send(new HobbyCreated(request('name'), $firstName));

                $this->sendSms($smsMessage);

            } catch (Exception $e) {

                return back()->with('message', 'Hobby created with errors');
            }

            return back()->with('message', 'Hobby successfully created');
        }
        
        return back()->with('message', 'Supplied hobby already registered');
        
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        request()->validate([
    		'title' => 'required|string|max:30',
    		'description'=> 'required|string'
        ]);

         $updatedHobby = Hobby::where('id', request('hobbyId'))
                ->where('user_id', \Auth::user()->id)
          ->update(['name' => request('title'), 'description'=>request('description')]);

        if($updatedHobby){
            $smsMessage = 'Your hobby '.request('title').' has been updated.';

            try {
                Mail::to(\Auth::user()->email)
                ->send(new HobbyUpdated(\Auth::user(), request('title')));

                $this->sendSms($smsMessage);

            } catch (Exception $e){

                return back()->with('message', 'Hobby updated with notification errors');
            }
           
        return back()->with('message', 'successfully updated one of your hobbies');
        }
        return back()->with('message', 'There was error updating your hobby, please retry');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if(Hobby::destroy(request('hobbyid'))){
            $smsMessage = 'You just deleted one of your hobbies.';

            try {

            Mail::to(\Auth::user()->email)
            ->send(new HobbyDeleted(\Auth::user()));
            
            $this->sendSms($smsMessage);

        } catch (Exception $e){
            report($e);
        }
        return back()->with('message', 'successfully deleted a hobby');

        }
        return back()->with('message', 'Unable to delete hobby, try again');

    }

    /**
     * TWillio sms method
     * @param $smsMessage - the message body
     * @return -object
     */
    private function sendSms($smsMessage)
    {
        $userPhone = '+234'.substr(\Auth::user()->phone, 1);

       $sid    = env( 'TWILIO_SID' );
       $token  = env( 'TWILIO_TOKEN' );
       $client = new Client( $sid, $token );

       return  $client->messages->create(
                   $userPhone,
                   [
                       'from' => env( 'TWILIO_FROM' ),
                       'body' => $smsMessage,
                   ]
               );        
   }
}
