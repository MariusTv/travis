<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ asset('vendor/table-view/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/table-view/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/table-view/css/themes/tableview-a.css') }}" rel="stylesheet" />
        
        <script src="{{ asset('vendor/table-view/js/jquery-1.9.1.min.js') }}"></script>

@include('table-view::scripts') 
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

        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div>
                    Demo of https://github.com/gbrock/laravel-table

                    {!! $table->render() !!}
                </div>
                <div>
                    Demo of https://github.com/nicolaslopezj/searchable
                    <ul>
                    @if($searched)
                        @foreach($searched as $usr)
                            <li>{{$usr->name}} {{$usr->email}}</li>
                        @endforeach
                    @else
                        Nothing. Add ?query=jonas for example
                    @endif
                    </ul>
                    
                </div>
                <div>
                    Demo of https://github.com/larkinwhitaker/laravel-table-viewable
                    @include('table-view::container', ['tableView' => $usersTableView])
                    
                </div>
            </div>
        </div>
    </body>
</html>
