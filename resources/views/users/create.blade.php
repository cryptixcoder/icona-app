@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			
			<div class="col-md-8 col-md-offset-2">
				<h3>New User</h3>
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="/users/create" method="post">
							{!! csrf_field() !!}
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group">
								<label>Type</label>
								<select name="type" id="" class="form-control">
									@foreach($types as $type)
										<option value="{{ $type['name'] }}">{{ $type['label'] }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<button class="btn btn-primary pull-right">Save User</button>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@stop