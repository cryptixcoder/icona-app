<template>
	
	<div class="wrapper">
		<a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" style="margin-top: -46px;">New Tow</a>

		<div class="modal fade" id="myModal" role="dialog" ref="input">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
		      </div>
		      <div class="modal-body">
		        <div class="button-group">
					<a href="#" @click="choosePrivateTow()" class="private-tow">Private Tow</a>
					<a href="#" @click="chooseContractTow()" class="contract-tow">Contract Tow</a>
				</div>
				
				<div class="form-group" v-show="isContractTow">
					<label>Contract</label>
					<select v-model="selectedContract" class="form-control">
						<option value="" selected>Choose Contract</option>
						<option v-for="contract in contracts" :value="contract.id">{{ contract.name }}</option>
					</select>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" @click.prevent="generateTow()">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>

</template>
<script>

	export default {

		mounted(){
			
			var $this = this;

			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				if(navigator.geolocation){
					navigator.geolocation.getCurrentPosition((position) => {
						$this.latitude = position.coords.latitude;
						$this.longitude = position.coords.longitude;
					});
				}
			}

			axios.get('/contracts?list=1')
				 .then((response) => {
				 	this.contracts = response.data.contracts
				 });
		
			this.$refs.input.modal();
		},

		data(){
			return {
				isPrivateTow: true,
				isContractTow: false,
				selectedContract: "",
				contracts: [],
				latitude: 0,
				longitude: 0
			}
		},


		methods: {
			choosePrivateTow(){
				this.isPrivateTow = true;
				this.isContractTow = false;
			},

			chooseContractTow(){
				this.isPrivateTow = false;
				this.isContractTow = true;
			},

			generateTow(){
				axios.post('/tows/create', {
					contract_id: this.selectedContract,
					latitude: this.latitude,
					longitude: this.longitude
				}).then((res) => {
					window.location = '/tows/' + res.data.tow_id + '/edit';
				});
			}
		}

	}
</script>