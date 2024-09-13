<!doctype html>
<html lang="en">
  <head>
  	<title>Login 05</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('logins/css/style.css')}}">

	</head>
    <body style="background-image: url('{{ asset('style2/img/bgcolor.jpg') }}'); background-size: cover; background-position: center;">
        <section class="ftco-section">
		<div class="container">
			{{-- <div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login #05</h2>
				</div>
			</div> --}}
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div >
                            <center>                            <img src="{{asset('style/images/LogoOur.jpg')}}" width="60%" alt="">
                            </center>
                        </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4"><b>Log In</b></h3>
			      		</div>
								{{-- <div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div> --}}
			      	</div>
                      <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mt-3">
			      			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
			      			<label class="form-control-placeholder" for="username">Email</label>
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
			      		</div>
                        <br>
		            <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <label class="form-control-placeholder" for="password">Password</label>
		              {{-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}

                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3" >Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	{{-- <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div> --}}
		            </div>
		          </form>
		          {{-- <p class="text-center">Not a member? </p>
                  <a href="/register"> <p>Register</p></a> --}}

		        </div>
				<p>Belum punya akun ? </p>
				<a href="/register" class="btn btn-warning text-dark">Register</a>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('logins/js/jquery.min.js')}}"></script>
  <script src="{{asset('logins/js/popper.js')}}"></script>
  <script src="{{asset('logins/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('logins/js/main.js')}}"></script>

	</body>
</html>