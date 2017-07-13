@extends('layouts.app')

@section('content')
	
	<div class="container">
		
        <div class="row">
        	<div class="col-md-12">
        		
        	</div>
        </div>
		<div class="row">
			<div class="col-md-3">
				@include('partials._search')
				
			</div>
			<div class="col-md-9">
							
    			<h2>Tows</h2>
				
				<new-tow></new-tow>	
				<div class="panel panel-default">

					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>TOW NUMBER</th>
									<th>TOWEE NAME</th>
									<th>LOCATION</th>
									<th>TOW DRIVER</th>
									<th>TOW DATE</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								@if($tows->count())
									@foreach($tows as $tow)
										
										<tr>
											<td>
												{{ $tow->tow_number }}
											</td>
											<td>
												{{ $tow->vehicle_owner }}
											</td>
											<td>
												{{ $tow->location }}
											</td>
											<td>
												{{ $tow->user->name }}
											</td>
											<td>
												{{ $tow->created_at->format('M d, Y') }}
											</td>
											<td>
												<a href="/tows/{{ $tow->id }}/edit">Edit</a>

												<a href="/tows/{{ $tow->id }}">View</a>
											</td>
										</tr>

									@endforeach
								@else
									<tr>
										<td colspan="6">
											<p align="center">You currently have no tows. <a href="/tows/create">Create a tow</a></p>
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