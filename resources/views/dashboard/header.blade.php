<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Indie Hackers</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <link href="{{asset('css/stylesheet.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('jquery/3.5.1/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('popper/popper.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('bootstrap.min.js')}}"></script>
    <style>
        .hover-class{
            background-color: white!important;
            color: black!important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #295a1d!important;color: white!important;">
    <a class="navbar-brand" href="{{url('/')}}" style="color: white!important;font-weight: bold">Polling System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">Link</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    Dropdown--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Another action</a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link disabled" href="#">Disabled</a>--}}
{{--            </li>--}}
        </ul>
        <form class="form-inline my-2 my-lg-0">
{{--            @if(empty(\Illuminate\Support\Facades\Session::get('userId')))--}}
{{--                <button class="btn hover-class" style="color: black!important;" onclick="location.href = `{{env('APP_URL')}}`">--}}
{{--                    LOGIN--}}
{{--                </button>--}}
{{--                <button class="btn hover-class ml-2"  style="color: black!important;" onclick="location.href = `{{env('APP_URL')}}`">--}}
{{--                    SIGNUP--}}
{{--                </button>--}}
{{--            @else--}}
{{--                <div class="nav-item dropdown" style="padding-right: 20px!important;">--}}
{{--                    <div class="dropleft">--}}
{{--                        <img src="{{asset('img/avatar.png')}}" class="top-avatar" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                            <a class="dropdown-item" onclick="window.location.href = `{{env('APP_URL')}}/profile`" href="#">Profile</a>--}}
{{--                            <a class="dropdown-item" href="#" onclick="logout()">Logout</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
        </form>
    </div>
</nav>



<script>
    function logout() {
        $.ajax({
            url: `{{env('APP_URL')}}/logout`,
            type: 'POST',
            dataType: "JSON",
            data: {"_token": "{{ csrf_token() }}"},
            success: function (result) {
                if (result.status === true) {
                    window.location.href = `{{env('APP_URL')}}`
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'server error! Please try again.',
                    });
                }
            },
        });
    }
</script>
</nav>
</body>
</html>
