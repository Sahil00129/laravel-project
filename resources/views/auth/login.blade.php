<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="UniPro App">
		<meta name="author" content="ParkerThemes">
		<link rel="shortcut icon" href="img/fav.png"/>

		<!-- Title -->
		<title>Login</title>


		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="{{('css/bootstrap.min.css')}}">
		
		<!-- Main css -->
		<link rel="stylesheet" href="{{('css/main.css')}}">


		<!-- *************
			************ Vendor Css Files *************
		************ -->

	</head>
	<body class="authentication">

		<!-- Loading wrapper start -->
		<div id="loading-wrapper">
			<div class="spinner-border"></div>
			Loading...
		</div>
		<!-- Loading wrapper end -->

		<!-- *************
			************ Login container start *************
		************* -->
		<div class="login-container">

			<div class="container-fluid h-100">

			<!-- Row start -->
			<div class="row g-0 h-100">
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
					<div class="login-about">
						<div class="slogan">
						<img src="img/etp.svg" alt="">
						</div>			

					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
					<div class="login-wrapper">
						
						<form action="{{ route('login.post') }}" method="POST">
							@csrf
							<div class="login-screen">
								<div class="login-body">
							
										<img src="img/billing.png" alt="iChat" style="width:70px;">
									</a>
									<h6>Welcome back,<br>Please login to your account.</h6>
									<div class="field-wrapper">
										<input type="text" id="email_address" class="form-control" name="email" required autofocus>
										<div class="field-placeholder">Email ID</div>
										@if (Session::get('success'))
                           <div class="alert alert-success" role="alert">
                               {{ Session::get('success') }}
                           </div>
                           @endif
										@if ($errors->has('email'))
										<span class="text-danger">{{ $errors->first('email') }}</span>
								    	@endif
									</div>
									<div class="field-wrapper mb-3">
										<input   type="password" id="password" class="form-control" name="password" required>
										<div class="field-placeholder">Password</div>
										@if ($errors->has('password'))
										<span class="text-danger">{{ $errors->first('password') }}</span>
								    	@endif
									</div>
									<div class="actions">
									
										<button type="submit" class="btn btn-primary">Login</button>
									</div>
								</div>
								<div class="login-footer">
								<!--	<span class="additional-link"><a href="{{ route('register') }}" class="btn btn-light">Sign Up</a></span> -->
								</div>  
								
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Row end -->
		
			</div>
		</div>
		<!-- *************
			************ Login container end *************
		************* -->

		<!-- *************
			************ Required JavaScript Files *************
		************* -->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<script src="{{('js/jquery.min.js')}}"></script>
		<script src="{{('js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{('js/modernizr.js')}}"></script>
		<script src="{{('js/moment.js')}}"></script>
		
		<!-- *************
			************ Vendor Js Files *************
		************* -->

		<!-- Main Js Required -->
		<script src="{{('js/main.js')}}"></script>

	</body>
</html>