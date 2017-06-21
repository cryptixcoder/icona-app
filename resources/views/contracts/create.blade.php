@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Create a contract
					</div>
					<div class="panel-body">
						<form action="/contracts/create" method="post">
							{!! csrf_field() !!}
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control" />
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" cols="30" rows="10" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>Contract Prefix</label>
								<input type="text" name="prefix" class="form-control" />
							</div>
							<div class="form-group">
								<button class="btn btn-primary pull-right">Create Contract</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop