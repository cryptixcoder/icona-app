@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
							
    			<h2>Private Tows</h2>
		
                <form action="/tows/printall" method="post">
                {!! csrf_field() !!}
				<div class="panel panel-default">

					<div class="table-responsive">
						
                            <table class="table table-striped table-bordered print-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>TOW NUMBER</th>
                                        <th>TOWEE NAME</th>
                                        <th>LOCATION</th>
                                        <th>TOW DRIVER</th>
                                        <th>TOW ON</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($tows->count())
                                        @foreach($tows as $tow)
                                            
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="tows[]" value="{{ $tow->id }}" />
                                                </td>
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
                                            </tr>

                                        @endforeach
                                    @else
                                        <tr>
                                            @if(Auth::user()->isType('admin'))
                                                <td colspan="6">
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
                <input type="submit" value="Print Selected" class="btn btn-primary">
                </form>
			</div>
		</div>
	</div>

@stop