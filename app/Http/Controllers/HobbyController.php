<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Mail\HobbyCreated;
use App\Mail\HobbyDeleted;
use App\Mail\HobbyUpdated;
use Mail;
use Illuminate\Http\Request;

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
            // Mail::to(\Auth::user()->email)
            //     ->send(new HobbyCreated(request('name'), \Auth::user()->firstName));

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
            Mail::to(\Auth::user()->email)
            ->send(new HobbyUpdated(\Auth::user(), request('title')));
         
        return back()->with('message', 'successfully updated hobby');
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
            Mail::to(\Auth::user()->email)
            ->send(new HobbyDeleted(\Auth::user()));

        return back()->with('message', 'successfully deleted a hobby');

        }
        return back()->with('message', 'Unable to delete hobby, try again');

    }
}
