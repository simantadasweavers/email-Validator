<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login and Signup Form </title>

        <!-- CSS -->
        <link rel="stylesheet" href="style.css">

        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <!-- jquery -->
        <script src="jquery.js"></script>
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Login</header>
                    <form action="{{url('/')}}/login" method="POST">
                        @csrf
                        <div class="field input-field">
                            <input type="email" name="uemail" placeholder="Email" class="input">
                            @error('uemail')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="password" name="upass" placeholder="Password" class="password">
                            @error('upass')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                            <button type="submit" id="loginbtn">Login</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                    </div>
                </div>

                <!-- <div class="line"></div>

                <div class="media-options">
                    <a href="#" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="#" class="field google">
                        <img src="#" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div> -->

            </div>

            <!-- Signup Form -->

            <div class="form signup">
                <div class="form-content">
                    <header>Signup</header>
                    <form action="{{url('/')}}/registration" method="POST" id="signupfrm">
                        @csrf
                    <div class="field input-field">
                            <input type="text" name="name" value="{{old('name')}}" placeholder="Full Name" class="input">
                            @error('name')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="text" name="phone"  value="{{old('phone')}}" placeholder="phone" class="input">
                            @error('phone')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="email" name="email"  value="{{old('email')}}" placeholder="email" class="input">
                            @error('email')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="password" name="pass1" id="pass1"  value="{{old('pass1')}}"  placeholder="Create password" class="password">
                            @error('pass1')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="password" name="pass2" id="pass2"  value="{{old('pass2')}}"  placeholder="Confirm password" class="password">
                            @error('pass2')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field button-field">
                            <button type="submit" id="signupbtn">Signup</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                    </div>
                </div>

                <!-- <div class="line"></div>

                <div class="media-options">
                    <a href="#" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="#" class="field google">
                        <img src="#" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div> -->

            </div>
        </section>

        <!-- JavaScript -->
        <script src="script.js"></script>

    </body>

    <!-- jquery code -->
    <script>
        $(document).ready(function(){
            $('#signupbtn').click(function(){
                var pass1 = $('#pass1').val();
                var pass2 = $('#pass2').val();

                if(pass1 != pass2){
                    alert("BOTH PASSWORDS NOT SAME!!");
                    $('#signupfrm')[0].reset();
                }
            });
        });
    </script>

</html>
