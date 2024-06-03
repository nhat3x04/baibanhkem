@extends('layout.master')
@section('content')

	<div class="container">
		<div id="content">
        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
			<form action="{{ route('postlogin') }}" method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" id="email" name="email" required>
						</div>
						<div class="form-block">
							<label for="password">Password*</label>
							<input type="password" id="password" name="password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Login</button>
							<li><a href="{{ route('getInputEmail') }}">Quên mật khẩu</a></li>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
            
        @if(Session::has('flag'))
        <div class="alert alert {{ Session::get('flag') }}">{{ Session::get('message') }}</div>
        @endif
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
