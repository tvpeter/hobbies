<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hobbies</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            /* html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            } */
        </style>
    </head>
    <body>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                    <div class="card text-center">
                        <div class="card-header">
                              <h4 class="card-title">Hobbies Mgmt Webapp</h4>
                        </div>
                            <div class="card-body">
                              <h4 class="card-title">Welcome</h4>

                              <p class="card-text">Manage all your hobbies here</p>

                              @if (Route::has('login'))
                              <div class="top-right links">
                                  @auth
                              <a class="btn btn-secondary btn-sm mt-2" href="{{url('/home')}}">Home</a>
                                  @else
                              <a class="btn btn-secondary btn-sm mt-2" href="{{ route('login') }}">Login</a>
                                      @if (Route::has('register'))
                              <a class="btn btn-secondary btn-sm mt-2" href="{{ route('register') }}">Register</a>
                                      @endif
                                  @endauth
                              </div>
                          @endif
                            </div>
                            <div class="card-footer">
                              <p class="text-muted font-weight-bold">Made by tvpeter</p>
                            </div>
                          </div>
            </div>
               
        </div>

            

            
           
    </body>
</html>
