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
<div  style="color: white">
    <div>
        <div class="container ">
            <div class="col-lg-5 offset-lg-1 header-title-section">
                <p class="header-title-text">Let's Get Started!</p>
                <div>
                    <label>First Name</label>
                    <input type="text" class="form-control" id="firstname">
                </div>
                <div>
                    <label>Last Name</label>
                    <input type="text" class="form-control" id="lastname">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="learn-more-btn-section" style="margin-top: 10px" onclick="signup()">
                    <button class="btn hover-class">SIGNUP</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function signup() {
        let firstname = document.getElementById('firstname').value;
        let lastname = document.getElementById('lastname').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        if(firstname === ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid First Name!',
            });
            return;
        }
        if(lastname === ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Last Name!',
            });
            return;
        }
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Email!',
            });
            return;
        }
        if(password === '' || password.length < 6){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Password! Must be greater than 5 characters',
            });
            return;
        }
        $.ajax({
            url: `{{env('APP_URL')}}/user/register`,
            type: 'POST',
            dataType: "JSON",
            data: {firstname : firstname,lastname : lastname, email: email, password: password, "_token": "{{ csrf_token() }}"},
            success: function (result) {
                if (result.status === true) {
                    window.location.href = `{{env('APP_URL')}}`
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message,
                    });
                }
            },
        });
    }
</script>
@endsection
