@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2>Tow Number: {{ $tow->tow_number }}</h2>
				<h4>Driver: {{ $tow->user->name }}</h4>
				<p>Towed On: {{ $tow->created_at->format('M d, Y h:i a') }}</p>
			
				@if($tow->photos()->count())
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<table class="table table-bordered">
									@foreach($tow->photos as $photo)
						
										<tr>
											<td width="50%">
												<img src="{{ $photo->fullpath }}" class="panel-thumbnail" style="width: 100%; height: auto;" alt="">
											</td>
											<td>
												<p>Notes: {{ $photo->notes }}</p>
												<p><a href="{{ $photo->fullpath }}" target="_blank">Download</a></p>
											</td>
										</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

@stop