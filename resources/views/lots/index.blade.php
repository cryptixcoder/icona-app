@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Lots</h2>
				<a href="/lots/create" class="btn btn-primary pull-right" style="margin-top: -46px;">Add Lot</a>
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
								@if($lots->count())
									@foreach($lots as $lot)
										
										<tr>
											<td>
												{{ $lot->id }}
											</td>
											<td>
												{{ $lot->name }}
											</td>
											<td>
												<a href="/lots/{{ $lot->id }}/edit">Edit</a>
											</td>
										</tr>


									@endforeach
								@else
									<tr>
										<td colspan="3">
											<p align="center">You currently have no lots. <a href="/lots/create">Create a lot</a></p>
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