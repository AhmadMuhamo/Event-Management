@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="margin-top: 10%">
			<div class="panel panel-default">
				<div class="panel-heading" style="font-weight: bold; text-align: center;">Register</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 col-xs-8 control-label">E-Mail</label>

							<div class="col-md-6 col-xs-12">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>

								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-md-4 col-xs-8 control-label">Password</label>

							<div class="col-md-3 col-xs-6">
								<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
							<div class="col-md-3 col-xs-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation" required>
							</div>
							<div class="col-md-offset-4 col-xs-12 col-md-6 ">
								@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div> 
						</div>
						<div class="form-group" style="align-items: center;">
							<div class="col-md-3 col-xs-6 col-md-offset-4">
								{!! Recaptcha::render() !!}
							</div>
							<div class="col-md-offset-4 col-xs-12 col-md-6">
								@if ($errors->has('g-recaptcha-response'))
								<span class="help-block">
									<strong>Please verify that you're a Human</strong>
								</span>
								@endif
							</div>
						</div>
						
                        
						<div class="form-group">
							<div style="text-align: center;">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
