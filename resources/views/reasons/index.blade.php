@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Reasons</h2>
				<a href="/reasons/create" class="btn btn-primary pull-right" style="margin-top: -46px;">New Reason</a>
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
									<th>NAME</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								@if($reasons->count())
									@foreach($reasons as $reason)
										
										<tr>
											<td>
												{{ $reason->id }}
											</td>
											<td>
												{{ $reason->name }}
											</td>
											<td>
												<a href="/reasons/{{ $reason->id }}/edit">Edit</a>
								
                                
											</td>
										</tr>

									@endforeach
								@else
									<tr>
										<td colspan="3">
											<p align="center">You currently have no reasons. <a href="/reasons/create">Create a reason</a></p>
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