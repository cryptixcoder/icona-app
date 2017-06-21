@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Tags</h2>
				<a href="/tags/create" class="btn btn-primary pull-right" style="margin-top: -46px;">New Tag</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>TAG</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@if($tags->count())
									@foreach($tags as $tag)
										
										<tr>
											<td>
												{{ $tag->id }}
											</td>
											<td>
												{{ $tag->tag }}
											</td>
											<td>
												<a href="/tags/{{ $tag->id }}/edit">Edit</a>
											</td>
										</tr>

									@endforeach
								@else
									<tr>
										<td colspan="3">
											<p align="center">You currently have no tags. <a href="/tags/create">Create a tag</a></p>
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop