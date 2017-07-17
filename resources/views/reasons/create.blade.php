@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			
			<div class="col-md-8 col-md-offset-2">
				<h3>New Reason</h3>
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="/reasons/create" method="post">
							{!! csrf_field() !!}
							<div class="form-group">
								<label>Reason</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-primary pull-right">Save Reason</button>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@stop