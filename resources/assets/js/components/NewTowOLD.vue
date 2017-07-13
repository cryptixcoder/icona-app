<template>
	<div class="modal-mask" @click="close()" v-show="show" transition="modal">
        <div class="modal-container clearfix" @click.stop>
            
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
			<div class="form-group">
				<button class="btn btn-primary pull-right"  @click.prevent="generateTow()" >Create Tow</button>
			</div>
        </div>
    </div>
</template>
<script>
	export default{
		props: ['show', 'onClose'],
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
		},
		methods: {
			close(){
				this.onClose();
			},
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