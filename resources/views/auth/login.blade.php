@extends('dashboard.layout')
@section('content')
    <style>
        .hover-class{
            background-color: #4799eb;
            color: white!important;
            padding: 10px!important;
        }
        .hover-class:hover{
            background-color:deeppink;!important;
        }
    </style>
<div style="color: white">
    <div>
        <div class="container">
            <div class="col-lg-5 offset-lg-1 header-title-section">
                <p class="header-title-text">Welcome Back!</p>
                <div>
                    <label>Email</label>
                    <input type="email" class="form-control" id="username">
                </div>
                <div style="margin-top: 10px">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password">
                </div>

                <div class="learn-more-btn-section" style="margin-top: 10px" onclick="login()">
                    <button class="btn hover-class">LOGIN</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function login() {
        let email = document.getElementById('username').value;
        let password = document.getElementById('password').value;
        if(email === ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Email!',
            });
            return;
        }
        if(password === ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Password!',
            });
            return;
        }
        $.ajax({
            url: `{{env('APP_URL')}}/login/authenticate`,
            type: 'POST',
            dataType: "JSON",
            data: {email: email, password: password, "_token": "{{ csrf_token() }}"},
            success: function (result) {
                document.getElementById('password').value = '';
                if (result.status === true) {
                    window.location.href = `{{env('APP_URL')}}`
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid email or password!',
                    });
                }
            },
        });
    }
</script>
@endsection
