@extends('layouts.app')

@section('content')
	
	<div class="container">
		
        <div class="row">
        	<div class="col-md-4 col-md-offset-8">
        		@include('partials._search')
        	</div>
        </div>
		<div class="row">
			<div class="col-md-12">
							
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
									<th>TOW ON</th>
									@if(Auth::user()->isType('admin'))
									<th>RELEASED</th>
									@endif
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
												{{ $tow->created_at->format('M d, Y h:i a') }}
											</td>
											@if(Auth::user()->isType('admin'))
											<td>
												<release towid="{{ $tow->id }}" ></release>
											</td>
											@endif
											<td>
												<a href="/tows/{{ $tow->id }}/edit">Edit</a>
												&nbsp;&nbsp;
												<a href="/tows/{{ $tow->id }}">View</a>
												&nbsp;&nbsp;
												<a href="#"
													onclick="event.preventDefault(); document.getElementById('delete-form-{{ $tow->id }}').submit();">
													 Delete
												</a>
												<form action="/tows/{{ $tow->id }}" id="delete-form-{{ $tow->id }}" method="post"  style="display: none;">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
												</form>
												{{-- &nbsp;&nbsp;
												<a href="/tows/{{ $tow->id }}?download=1">Download</a> --}}
											</td>
										</tr>

									@endforeach
								@else
									<tr>
										@if(Auth::user()->isType('admin'))
											<td colspan="7">
												<p align="center">You currently have no tows. <a href="/tows/create">Create a tow</a></p>
											</td>
										@else
											<td colspan="6">
												<p align="center">You currently have no tows. <a href="/tows/create">Create a tow</a></p>
											</td>
										@endif
									</tr>
								@endif
							</tbody>
						</table>
															
					
					</div>
					
				</div>
				{{ $tows->links() }}
			</div>
		</div>
	</div>

@stop