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
                    <div class="form-group">
                        <label style="color: #707070;font-size: 25px">What do you want to know?</label>
                       <textarea style="padding: 10px" class="form-control" rows="6" placeholder="For example : Who's in? , what color do you like?" id="poll-title"></textarea>
                    </div>

                    <div class="form-group" style="margin-top: 10px">
                        <label style="color: #707070;font-size: 25px">What are the answers?</label>
                        <div id="answers-div">
                            <input style="height: 60px;margin-top: 10px" class="form-control" placeholder="for example : yes" id="first-answer">
                            <input style="height: 60px;margin-top: 10px" class="form-control" placeholder="for example : no">
                        </div>
                        <div style="font-size: 50px;color: #707070;cursor: pointer; width: 50px" onclick="addAnswer()">
                            &plus;
                        </div>
                        <button class="finish-btn" onclick="submit()">
                            Finish Poll and get the link
                        </button>
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

        function submit(){
          let pollTitle = document.getElementById('poll-title').value;
          let firstAnswer = document.getElementById('first-answer').value;
          if (pollTitle === '' || pollTitle === undefined){
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Please write down your poll title',
              });
              return
          }
          if (firstAnswer === '' || firstAnswer === undefined){
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Please write atleast one answer',
              });
              return;
          }
          window.location.href = `{{env('APP_URL')}}/copy-urls`
        }
    </script>
@endsection
