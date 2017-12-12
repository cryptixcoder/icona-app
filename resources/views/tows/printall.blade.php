@extends('layouts.app')

@section('content')

    @foreach($tows as $tow)
    <div class="container print-page">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2>Tow Number: {{ $tow->tow_number }}</h2>
				<h4>Driver: {{ $tow->user->name }}</h4>
				<p>Towed On: {{ $tow->created_at->format('M d, Y h:i a') }}</p>
				<p><a href="/tows/{{ $tow->id }}?viewphotos=1">View Photos</a></p>

				<div class="panel panel-default">
				
					<table class="table table-striped table-bordered print-table">
						<tr>
							<td width="50%">Reason:</td>
							<td>{{ ($tow->reason_id) ?  $tow->reason->name : "" }}</td>
						</tr>
						<tr>
							<td width="50%">Vehicle Owner:</td>
							<td>{{ $tow->vehicle_owner }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Phone:</td>
							<td>{{ $tow->phone }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Vehicle Year:</td>
							<td>{{ $tow->year }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Vehicle Make:</td>
							<td>{{ $tow->make }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Vehicle Model:</td>
							<td>{{ $tow->model }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Vehicle Color:</td>
							<td>{{ $tow->vehicle_color }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">State:</td>
							<td>{{ $tow->state }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Tag Number:</td>
							<td>{{ $tow->tag_number }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Vehicle Identification Number:</td>
							<td>{{ $tow->vin }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Mileage:</td>
							<td>{{ $tow->mileage }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Officer ID:</td>
							<td>{{ $tow->officer_id }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Complaint ID:</td>
							<td>{{ $tow->complaint_id }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Location:</td>
							<td>{{ $tow->location }}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Lot:</td>
							<td>
								@if($tow->lot)
									{{ $tow->lot->street_address }}, {{ $tow->lot->city }},{{ $tow->lot->state }},{{ $tow->lot->zipcode }}
								@endif
							</td>
						</tr>
						<tr>
							<td style="width: 50%;">Tags</td>
							<td>{{ $tow->tags }}</td>
						</tr>
						<tr>
							<td style="width:50%;">Notes</td>
							<td>{{ $tow->notes  }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		

		@foreach($tow->children as $child)
			<div class="row print-page">
				<div class="col-md-8 col-md-offset-2">
					<h2>Tow Number: {{ $child->tow_number }}</h2>
					<p><a href="/tows/{{ $child->id }}?viewphotos=1">View Photos</a></p>
					<div class="panel panel-default">
						
						<table class="table table-striped table-bordered print-table">
							<tr>
								<td style="width: 50%;">Vehicle Year:</td>
								<td>{{ $child->year }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">Vehicle Make:</td>
								<td>{{ $child->make }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">Vehicle Model:</td>
								<td>{{ $child->model }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">Vehicle Color:</td>
								<td>{{ $child->vehicle_color }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">State:</td>
								<td>{{ $child->state }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">Tag Number:</td>
								<td>{{ $child->tag_number }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">Vehicle Identification Number:</td>
								<td>{{ $child->vin }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">Mileage:</td>
								<td>{{ $child->mileage }}</td>
							</tr>
							<tr>
								<td style="width: 50%;">Lot:</td>
								<td>
									
									@if($child->lot)
										{{ $child->lot->street_address }}, {{ $child->lot->city }},{{ $child->lot->state }},{{ $child->lot->zipcode }}
				
									@endif
								</td>
							</tr>
							<tr>
								<td style="width: 50%;">Tags</td>
								<td>{{ $child->tags }}</td>
							</tr>
						</table>
						
					</div>
		
				</div>
			</div>
		@endforeach
	</div>
    @endforeach

@stop