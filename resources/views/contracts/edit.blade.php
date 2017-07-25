@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Update Contract
					</div>
					<div class="panel-body">
						<form action="/contracts/{{ $contract->id }}/edit" method="post">
							{!! csrf_field() !!}
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control" value="{{ $contract->name }}" />
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" cols="30" rows="10" class="form-control">{{ $contract->description }}</textarea>
							</div>
							<div class="form-group">
								<label>Start Tow Count</label>
								<input type="text" name="tow_start_count" class="form-control" value="{{ $contract->tow_start_count }}">
							</div>
							<div class="form-group">
								<label>Contract Prefix</label>
								<input type="text" name="prefix" class="form-control" value="{{ $contract->prefix }}" />
							</div>
							<div class="form-group">
								<button class="btn btn-primary pull-right">Save Contract</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop