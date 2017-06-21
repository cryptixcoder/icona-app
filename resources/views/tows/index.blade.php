@extends('layouts.app')

@section('content')
	<div class="container">
		 <div class="row">
            <div class="col-md-12">
                <form action="/search" method="get" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" name="q" class="form-control" placeholder="Search" value="{{ Request::get('q') }}">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<h2>Tows</h2>
				<new-tow :show.sync="showTowModal" :on-close="closeTowModal"></new-tow>
    			<button class="btn btn-primary pull-right" style="margin-top: -46px;" id="show-modal" @click.prevent="showTowModal = true">New Post</button>
				<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>TOW NUMBER</th>
									<th>TOWEE NAME</th>
									<th>LOCATION</th>
									<th>Tow Date</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@if($tows->count())
									@foreach($tows as $tow)
										
										<tr>
											<td>
												{{ $tow->id }}
											</td>
											<td>
												{{ $tow->tow_number }}
											</td>
											<td>
												{{ $tow->name }}
											</td>
											<td>
												{{ $tow->location }}
											</td>
											<td>
												{{ $tow->created_at->format('M d, Y') }}
											</td>
											<td>
												<a href="/tows/{{ $tow->id }}/edit">Edit</a>
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