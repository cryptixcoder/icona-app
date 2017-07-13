@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Invoices</h3>
				<a href="/invoices/create">New Invoice</a>
			</div>
		</div>
		<div class="row">
			
			<div class="col-md-12">
				
				<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Issued On</th>
									<th>Invoice #</th>
									<th>Customer</th>
									<th>Total</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Jun 30, 2017</td>
									<td>010</td>
									<td>Markus Gray</td>
									<td>$300.00</td>
									<td>
										<a href="/invoices/1/edit">Edit</a>
										<a href="/invoices/1/pdf">View PDF</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@stop