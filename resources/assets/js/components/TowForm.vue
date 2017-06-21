<template>
	
	<div class="wrapper">
		<h3>Manage Tow #{{ tow_number }}</h3>
		<div class="panel panel-default">
		<div class="panel-body">
			<form>
		
				<div class="alert" v-if="message" :class="{ 'alert-success' : success, 'alert-danger' : error  }" >
					{{ message }}
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Complaint Number</label>
							<input type="text" class="form-control" v-model="complaint_number" />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Tow Time</label>
							<input type="text" class="form-control" v-model="time"  />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Officer ID</label>
							<input type="text" class="form-control" v-model="officer_id"  />
						</div>
						
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Vehicle Owner Name</label>
							<input type="text" class="form-control" v-model="name"  />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone Number</label>
							<input type="text" class="form-control" v-model="phone"  />
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Location</label>
							<input type="text" class="form-control" v-model="location"  />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Vehicle Make</label>
							<input type="text" class="form-control" v-model="make"  />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Vehicle Model</label>
							<input type="text" class="form-control" v-model="model"  />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Vehicle Year</label>
							<input type="text" class="form-control" v-model="year"  />
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>State</label>
							<input type="text" class="form-control" v-model="state"  />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Tag Number</label>
							<input type="text" class="form-control" v-model="tag_number"  />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Color</label>
							<input type="text" class="form-control" v-model="color"  />
						</div>
					</div>
				</div>
			
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>VIN#</label>
							<input type="text" class="form-control" v-model="vin"  />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Mileage</label>
							<input type="text" class="form-control" v-model="mileage"  />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Tags</label>
							<input type="text" class="form-control" v-model="tags" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h3>Photos</h3>
						<input type="file" class="attached-photos" multiple @change="onPhotosAttached()" ref="photos">
						<a href="#" @click.prevent="attachPhotos()" class="btn btn-primary pull-right add-photo-btn">Add Photos</a>
						<hr>
					</div>
				</div>
				<div class="row" style="margin-bottom:30px; ">
					<div class="col-md-3 col-sm-12 col-xs-12">
						<img src="http://placehold.it/500x500" style="width: 100%; height: auto; display:block; margin-bottom: 10px;" alt="">
					</div>

					<div class="col-md-3 col-sm-12 col-xs-12">
						<img src="http://placehold.it/500x500" style="width: 100%; height: auto; display:block; margin-bottom: 10px;" alt="">
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<img src="http://placehold.it/500x500" style="width: 100%; height: auto; display:block; margin-bottom: 10px;" alt="">
					</div>

				</div>
			</form>
		</div>
	</div>	
	<a @click="addChild()" v-show="parent_id == null">Add Child</a>
	<tow-form tow-id="100" v-for="child in children"></tow-form>
	</div>

</template>
<script>
	import eventBus from '../events.js';

	export default {
		data(){
			return {
				id: null,
				name: "",
				phone: "",
				tow_number: "",
				location: "",
				parent_id: null,
				make: "",
				model: "",
				year: "",
				color: "",
				time: "",
				state: "",
				tag_number: "",
				vin: "",
				mileage: "",
				officer_id: "",
				complaint_number: "",
				tags: "",
				interval: null,
				message: null,
				error: false,
				success: false,
				lots: [],
				children: []
			}
		},

		props: ['towid'],

		mounted(){
			this.loadTowRecord();
			this.initAutoSave();
		},

		methods: {
			loadTowRecord(){
				axios.get('/tows/' + this.towid)
					 .then((response) => {
					 	var tow = response.data;

					 	this.id = tow.id;
					 	this.name = tow.name;
					 	this.phone = tow.phone;
					 	this.tow_number = tow.tow_number;
					 	this.location = tow.location;
					 	this.make = tow.make;
					 	this.model = tow.model;
					 	this.year = tow.year;
					 	this.color = tow.color;
					 	this.time = tow.time;
					 	this.state = tow.state;
					 	this.tag_number = tow.tag_number;
					 	this.vin = tow.vin;
					 	this.mileage = tow.mileage;
					 	this.officer_id = tow.officer_id;
					 	this.complaint_number = tow.complaint_number;
					 	this.tags = tow.tags;

					 },(err) => {

					 });
			},
			updateTowRecord(){
				this.saveStatus = "Saving Record...";
				axios.put('/tows/' + this.id, {
					name: this.name,
					phone: this.phone,
					tow_number: this.tow_number,
					location: this.location,
					make: this.make,
					model: this.model,
					year: this.year,
					color: this.color,
					time: this.time,
					state: this.state,
					tag_number: this.tag_number,
					vin: this.vin,
					mileage: this.mileage,
					officer_id: this.officer_id,
					complaint_number: this.complaint_number,
					tags: this.tags
				})
				.then((response) => {
					console.log(response);

					// this.message = "Record Updated.";
					// this.success = true;

					// setTimeout(() => {
					// 	this.message = null;
					// 	this.success = false;
					// }, 2000);

				}, (err) => {
					console.log(err);
				});
			},

			genPhotoObject(photo){
				var index = this.photos.push({
					id: null,
					photo: photo,
					finished: false
				}) - 1;

				return this.photos[index];
			},

			storePhotoData(photo){
				var photoObject = this.genPhotoObject(photo);

				return new Promise((resolve, reject) => {
					axios.post('/photos', {
						tow_id: this.tow.id
					}).then((response) => {
						photoObject.id = response.data.id;
						resolve(photoObject);
					}, () => {
						reject(photoObject);
					});
				});
			},

			initAutoSave(){
				this.interval = setInterval(() => {
					this.updateTowRecord();
				}, 5000);
			},

			loadLots(){
				axios.get('/lots')
					 .then((response) => {
					 	this.lots = response.data.lots;
					 }, (err) => {

					 });
			},

			attachPhotos(){
				this.$refs.photos.click();
			},

			onPhotosAttached(){

			},

			addChild(){
				this.children.push({
					id: null,
					name: "",
					phone: "",
					tow_number: "",
					location: "",
					make: "",
					model: "",
					year: "",
					color: "",
					time: "",
					state: "",
					tag_number: "",
					vin: "",
					mileage: "",
					officer_id: "",
					complaint_number: "",
					parent_id: true,
					tags: "",
					interval: null,
					message: null,
					error: false,
					success: false,
					lots: [],
					children: []
				});
			}
		}
	}
</script>