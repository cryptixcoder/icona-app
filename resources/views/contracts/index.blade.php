@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Contracts</h2>
				<a href="/contracts/create" class="btn btn-primary pull-right" style="margin-top: -46px;">Add Contract</a>
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
								@if($contracts->count())
									@foreach($contracts as $contract)
										
										<tr>
											<td>
												{{ $contract->id }}
											</td>
											<td>
												{{ $contract->name }}
											</td>
											<td>
												<a href="/contracts/{{ $contract->id }}/edit">Edit</a>
												&nbsp;&nbsp;&nbsp;
												<a href="/tows?contract={{ $contract->id }}">View Tows</a>
											</td>
										</tr>


									@endforeach
								@else
									<tr>
										<td colspan="3">
											<p align="center">You currently have no contracts. <a href="/contracts/create">Create a contract</a></p>
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