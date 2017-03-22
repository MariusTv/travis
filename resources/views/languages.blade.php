<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link href="{{ asset('vendor/table-view/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/table-view/css/themes/tableview-a.css') }}" rel="stylesheet" />
        
        <script src="{{ asset('vendor/table-view/js/jquery-1.9.1.min.js') }}"></script>

        <style>
            html, body {
                height: 100%;
            }


            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
                
            }

            .content {
                text-align: center;
                display: inline-block;
            }
            #mmap{
                width: 1200px;
                height: 800px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div id='mmap'>
            {!! $map !!}
            </div>
        </div>
    </body>
</html>
