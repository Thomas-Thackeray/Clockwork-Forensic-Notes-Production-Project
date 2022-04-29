<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>


	<section id = 'login_backDrop'>

		<h1>Clockwork Forensic Notes - Product ID: 00001</h1>

		<section id = 'form_wrapper'>

			<figure id = 'companyLogo_container'><img src="{{ asset('storage/images/logo.png') }}" alt=""> </figure>
			<h2>LBU Forensic Investigators</h2>
            <p style = 'color: white; font-weight: bold;'>For marking purposes random generated code has been bypassed</p>
            <p style = 'color: white; font-weight: bold; margin-bottom: 20px;'>username: test@test.com | password: password123</p>

            <!-- When the submit button is clicked handle the form using the login route -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Username Field-->
                <div class = 'login_inputGrouping'>

                    <i class="login_icon fa fa-user" style="font-size:23px"></i> 

                    <x-input id="email" class="block mt-1 w-full"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required autofocus />

                    <span class = 'login_usernameValidation'></span>
                </div>
                <!-- Password Field -->
                <div class = 'login_inputGrouping'>

                    <i class="login_icon fa fa-lock" style="font-size:23px"></i>

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <span class = 'login_usernameValidation'></span>

					<p id="Warning">WARNING! Caps lock is ON.</p>
                </div>

                <div class = 'login_inputGrouping'>
                    <x-button class="ml-3">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>

			<p>Forgot Username / Password <a href = '#'>Click Here</a></p>
			

		</section>

	</section>

</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap');
* {
	padding: 0px;
	margin: 0px;
	box-sizing: border-box;
}

#login_backDrop {
	width: 100%;
	min-height: 100vh;
    background: rgb(0,91,234);
    background: linear-gradient(90deg, rgba(0,91,234,1) 0%, rgba(0,198,251,1) 51%);

	display:  flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}
#login_backDrop  h1 {
	position: absolute;
	top: 5px;
	left: 5px;
	font-size: 13px;
	color: white;
}
#form_wrapper {
	height: auto;
	width: 390px;
	display: flex;
	flex-direction: column;
	justify-content: center;
}
#form_wrapper p {
	color: #ccc;
	text-align: center;
	font-family: 'Montserrat', sans-serif;
	font-size: 13px;
	font-weight: 100;
}
#form_wrapper p a {
	color: #ccc;
	transition: 0.3s;
}
#form_wrapper p a:hover {
	cursor: pointer;
	color: blue;
}
#form_wrapper form {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: space-between;
	min-height: 150px;
}
#form_wrapper h2 {
	color: white;
	font-family: 'Montserrat', sans-serif;
	margin-bottom: 35px;
	text-align: center;
	font-size: 22px;
	letter-spacing: 0.5px;
}
#companyLogo_container {
	width: 120px;
	height: 120px;
	border-radius: 50%;
	overflow: hidden;
	margin: 0 auto;
	/*border: 1px solid #24292f;*/
	padding: 4px;
	margin-bottom: 20px;
}
#companyLogo_container img {
	width:  100%;
}


/*DELETE AFTER THIS*/
.login_inputGrouping {
	width: 100%;
	position: relative;
	margin-bottom: 10px;
}
.login_inputGrouping input {
  font-family: 'Montserrat', sans-serif;
  font-size: 15px;
  line-height: 1.2;
  color: #333;
  display: block;
  width: 100%;
  background: #fff;
  height: 50px;
  border-radius: 25px;
  padding: 0 30px 0 53px;
  border: none;
  font-weight: 800;
}
.login_inputGrouping input::placeholder {
  color: #999;
}

.login_icon {
	position: absolute;
	top: 12px;
	left: 16px;
	color: #999;
}
#login_submitButton {
	background-color: #24292f;
	font-family: 'Montserrat', sans-serif;
	padding: 0px;
	font-size: 15px;

	color: white;
	transition: 0.5s;
	border: 1px solid transparent;
}
#login_submitButton:hover {
	cursor: pointer;
	background-color: #006bec;
	border: 1px solid white;
}
#Warning {
	margin-top: 8px;
	display: none;
	color: red !important;
	font-family: 'Montserrat', sans-serif;
	font-weight: 800 !important;
	font-size: 13px !important;
}


</style>

<script>
var input = document.getElementById("password_input");
var text = document.getElementById("Warning");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>