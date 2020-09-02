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
                        <label style="color: #707070;font-size: 25px">Your Name</label>
                        <input style="height: 60px;margin-top: 10px" class="form-control" placeholder="your name" id="user-name">
                    </div>
                    <div class="form-group">
                        <p style="font-size: 22px">{{$poll->title}}?</p>
                    </div>
                    <input type="hidden" id="total-answers" value="{{count($answers)}}">
                    <div class="form-group" style="margin-top: 10px">
                        @foreach($answers as $key => $answer)
                        <div id="answers-div">
                            <p>{{$key+1}}. <button class="btn btn-outline-dark" id="btn-number-{{$key}}" onclick="selectAnswer('{{$key}}')">{{$answer->answer}}</button></p>
                        </div>
                          @endforeach
                    </div>
                    <button class="finish-btn" onclick="submit()">
                        Submit
                    </button>

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
        let arrList = [];
        arrList.push(0);
        arrList.push(1);
        let answerIndex = 1;
        let answersList = [];

        function selectAnswer(index) {
            let totalanswers = document.getElementById('total-answers').value;
            for (let i = 0; i < totalanswers; i++) {
                document.getElementById('btn-number-' + i).classList.remove('btn-dark');
                document.getElementById('btn-number-' + i).classList.remove('btn-outline-dark');
                document.getElementById('btn-number-' + i).classList.add('btn-outline-dark');
            }
            document.getElementById('btn-number-' + index).classList.remove('btn-outline-dark');
            document.getElementById('btn-number-' + index).classList.add('btn-dark');
        }
        function addAnswer(){
            answerIndex++;
            arrList.push(answerIndex);
            let answerDiv = document.getElementById('answers-div');
            let input = document.createElement('input');
            input.classList.add('form-control');
            input.style = "height: 60px;margin-top: 10px";
            input.setAttribute('placeholder', 'for example : yes');
            input.setAttribute('id', 'first-answer-' + answerIndex);
            answerDiv.appendChild(input);
        }

        function submit(){
            let name = document.getElementById('user-name').value;
            if (name === '' || name === undefined){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter your name',
                });
                return
            }
            document.getElementById('user-name').value = '';
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Thankyou for you vote.',
            });

            return;
            $.ajax({
                url: `{{env('APP_URL')}}/poll/save`,
                type: 'POST',
                dataType: "JSON",
                data: {"_token": "{{ csrf_token() }}", 'pollTitle' : pollTitle, answersList : JSON.stringify(answersList)},
                success: function (result) {
                    if (result.status === true) {
                        window.location.href = `{{env('APP_URL')}}/copy-urls/${result.url}`
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
@endsection
