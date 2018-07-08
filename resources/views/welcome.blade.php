<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <script>window.Laravel = {csrfToken: {{csrf_token()}}}</script>

        <title>Triboard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{asset('css/materialize.css')}}" rel="stylesheet" type="text/css">



    </head>
    <body>



            <div id="app">
              <navbar></navbar>
              <div class ="container">
                  <todo></todo>
              </div>
            </div>

        </div>
      <script src ="{{asset('js/app.js')}}"></script>
      <script src ="{{asset('js/materialize.js')}}"></script>
      <script src ="{{asset('js/jquery.js')}}"></script>
     
    </body>
</html>
