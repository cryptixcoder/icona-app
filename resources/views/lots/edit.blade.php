@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Update Lot
					</div>
					<div class="panel-body">
						<form action="/lots/{{ $lot->id }}/edit" method="post">
							{!! csrf_field() !!}
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control" value="{{ $lot->name }}" />
							</div>
							<div class="form-group">
								<label>Street Address</label>
								<input type="text" name="street_address" class="form-control" value="{{ $lot->street_address }}" />
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>City</label>
										<input type="text" name="city" class="form-control" value="{{ $lot->city }}" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>State</label>
										<input type="text" name="state" class="form-control" value="{{ $lot->state }}" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Zip Code</label>
										<input type="text" name="zipcode" class="form-control" value="{{ $lot->zipcode }}" />
									</div>
								</div>
							</div>
							
							
							
							<div class="form-group">
								<button class="btn btn-primary pull-right">Save Lot</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop