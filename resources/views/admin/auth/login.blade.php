@extends('layouts.base_auth')
@section('content')
    <div class="limiter">
		<div class="container-login100" style="background-image: url({{url('assets/login/images/img-01.jpg')}});">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action="{{route('admin.login.post')}}" method="POST">
                    @csrf
					<div class="login100-form-avatar">
						<img src="{{url('assets/login/images/avatar-01.png')}}">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Login
					</span>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

					<div class="wrap-input100 @error('username') validate-input @enderror  m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="NIS">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 @error('password') validate-input @enderror m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

