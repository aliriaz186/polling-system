@extends('dashboard.layout')
@section('content')

    <style>
        .header-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row
        }

        .hover-class {
            background-color: #4799eb;
            color: white !important;
            padding: 10px !important;
        }

        .hover-class:hover {
            background-color: deeppink;
        !important;
        }
    </style>
    <div>
        <div class="py-5">
            <h2 class="text-center">Polling System</h2>
            {{--            <p class="text-center text-white">Learn from the makers behind hundreds of profitable businesses and side--}}
            {{--                projects.</p>--}}
            <div class="container" style="max-width: 1200px;margin-top: 20px" >
                <div class="main-div">

                    <div class="form-group" style="margin-top: 10px">
                        <label style="color: #707070;font-size: 25px">Admin Link - don't share it. with this link your poll will be modified</label>
                        <div>
                            <input value="{{env('APP_URL')}}/SSDFEdsd" style="height: 60px;margin-top: 10px;width: 98%;display: inline" class="form-control" id="admin-link"><span onclick="copyLink('admin-link', 'Admin')" style="font-size: 50px;position: relative;margin-left: -50px;cursor: pointer">&#128456;</span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                        <label style="color: #707070;font-size: 25px">User Link - share it. with this link others can vote</label>
                        <div>
                            <input  value="{{env('APP_URL')}}/sdfsdEFE4"  style="height: 60px;margin-top: 10px;width: 98%;display: inline" class="form-control" id="user-link"><span onclick="copyLink('user-link', 'User')" style="font-size: 50px;position: relative;margin-left: -50px;cursor: pointer">&#128456;</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    {{--    <div class="footer-section" style="background-color: #1f364d">--}}
    {{--        <div class="footer-section-bg-graphics">--}}
    {{--            <img src="{{asset('landing-page-styles/images/footer-section-bg.png')}}">--}}
    {{--        </div>--}}

    {{--        <div class="container footer-container">--}}
    {{--            <div class="col-lg-3 col-md-6 footer-subsection">--}}
    {{--                <div class="footer-subsection-2-1">--}}
    {{--                    <h3 class="footer-subsection-title">About</h3>--}}
    {{--                    <p class="footer-subsection-text">Domain Giving company</p>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="col-lg-3 col-md-6 footer-subsection">--}}
    {{--                <h3 class="footer-subsection-title">Contact Us</h3>--}}
    {{--                <ul class="footer-subsection-list">--}}
    {{--                    <li>123 Business Centre<br>London SW1A 1AA</li>--}}
    {{--                    <li>0123456789</li>--}}
    {{--                    <li><a class="__cf_email__" data-cfemail="701d11191c30">dummy@domain.com</a></li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="container footer-credits">--}}
    {{--            <p>&copy; 2020 <a href="#">Website</a>. All Rights Reserved.</p>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <script>
        function addAnswer(){
            let answerDiv = document.getElementById('answers-div');
            let input = document.createElement('input');
            input.classList.add('form-control');
            input.style = "height: 60px;margin-top: 10px";
            input.setAttribute('placeholder', 'for example : yes');
            answerDiv.appendChild(input);
        }

        function copyLink(id, type) {
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: type + " link copied",
            });
        }
    </script>
@endsection
