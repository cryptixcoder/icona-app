@extends('layouts.app')

@section('content')

	<div class="container">
	<div class="row">
		<div class="col-md-12" style="clearfix: both;">
			<h3>Users</h3>
				<a href="/users/create" class="btn btn-primary pull-right" style="margin-top: -46px;">Add User</a>
		</div>
	</div>
		<div class="row">
			
			<div class="col-md-12">

				<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>NAME</th>
									<th>TYPE</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								@if($users->count())
									@foreach($users as $user)
										
										<tr>
											<td>
												{{ $user->id }}
											</td>
											<td>
												{{ $user->name }}
											</td>
											<td>
												{{ $user->user_type }}
											</td>
											<td>
												<a href="/users/{{ $user->id }}/edit">Edit</a>
											</td>
										</tr>


									@endforeach
								@else
									<tr>
										<td colspan="4">
											<p align="center">You currently have no users. <a href="/users/create">Create a user</a></p>
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