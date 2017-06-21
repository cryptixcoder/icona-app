@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			
			<div class="col-md-8 col-md-offset-2">
				<h3>Edit Tag</h3>
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="/tags/{{$tag->id}}/edit" method="post">
							{!! csrf_field() !!}
							<div class="form-group">
								<label>Tag</label>
								<input type="text" name="tag" class="form-control" value="{{ $tag->tag }}" >
							</div>
							<div class="form-group">
								<button class="btn btn-primary pull-right">Save Tag</button>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@stop