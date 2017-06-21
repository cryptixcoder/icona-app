<template>
	<div class="panel panel-default">
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-6">
					<h6>FROM</h6>
					<p>Icona Collision & Repair</p>
					<p>601 Concord Avenue Complex, <br>Suite 1</p>
					<p>Chester, Pa 19013</p>
				</div>

				<div class="col-md-6">
					<h6>TO</h6>
					<p>Markus Gray</p>
					<p>1513 Concord Ave</p>
					<p>Chester, Pa 19013</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<h6>Issued On</h6>
					<p>Jun 07, 2017</p>
				</div>

				<div class="col-md-6">
					<h6>Due On</h6>
					<p>Jun 07, 2017</p>
				</div>
			</div>
	

			<div class="row">
				<table class="table">
					<thead>
						<tr>
							<th>
								ITEM NAME
							</th>
							<th>
								DESCRIPTION
							</th>
							<th>
								UNITS
							</th>
							<th>
								RATE
							</th>
							<th>
								TOTAL
							</th>
							<th>
								
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" id="item" class="invoice-input">
							</td>
							<td>
								<input type="text" id="item" class="invoice-input">
							</td>
							<td>
								<input type="text"  id="unit" class="invoice-input">
							</td>
							<td>
								<input type="text"  id="rate" class="invoice-input">
							</td>
							<td>
								<span></span>
							</td>
							<td>
								<a>X</a>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<h4>Subtotal</h4>
								<h5>0% Tax</h5>
								<h5>$0.00 Discount</h5>
							</td>
							<td colspan="2">
								<h4>$100</h4>
								<h5>$0.00</h5>
								<h5>-$0.00</h5>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<h3>Total</h3>
							</td>
							<td colspan="2">
								<h3>$100.00</h3>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</template>
<script>
	export default {
		data(){
			return {

			}
		},

		mounted(){

		},

		methods: {

		}
	}
</script>