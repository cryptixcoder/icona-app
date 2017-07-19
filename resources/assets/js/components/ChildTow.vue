<template>
	
	<div class="wrapper">
		<h3>Manage Tow #{{ tow_number }} </h3>
		<div class="panel panel-default">
		<div class="panel-body">
			<form>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Vehicle Year</label>
							<input type="text" class="form-control" v-model="year"  />
						</div>
					</div>
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
				</div>
				
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>State</label>
							
							<select class="form-control" v-model="state">
								<option value="">Select State</option>
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
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
							<input type="text" class="form-control" v-model="vehicle_color"  />
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
							<label>Lot</label>
							<select v-model="lot_id" class="form-control">
								<option value="" selected>Choose Lot</option>
								<option v-for="lot in lots" :value="lot.id">{{ lot.name }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h3>Photos <a href="#" @click.prevent="attachPhotos()" class="add-photo-btn"><small>+ Add Photos</small></a></h3>
						<input type="file" class="attached-photos" accept="image/*" capture="camera" multiple @change="onPhotosAttached()" ref="photos">
						<hr>
					</div>
				</div>
				<div class="row" style="margin-bottom:30px; ">

					<photo v-for="photo in photos" :photo="photo"></photo>

				</div>

				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<a href="" class="pull-left" @click.prevent="confirmRemove()" >Remove</a>
							<button class="btn btn-primary pull-right" @click.prevent="updateTowRecord()" >Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>	
	</div>

</template>
<script>
	import eventBus from '../events.js';
	import Selectize from 'vue2-selectize';
	import selectize from 'selectize';

	export default {
		components: {
		    Selectize
		},
		data(){
			return {
				id: null,
				vehicle_owner: "",
				phone: "",
				tow_number: "",
				location: "",
				parent_id: null,
				make: "",
				model: "",
				year: "",
				vehicle_color: "",
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
				lot_id: '',
				lots: [],
				children: [],
				photos: [],
				tow_time: "",
				tags: [],
				tlist: [],
				valid: false,
				timer: null
			}
		},

		props: ['towid', 'towindex'],

		mounted(){
			this.loadTags();
			this.loadLots();
			this.loadTowRecord();
			
			this.initAutoSave();
			
			// this.timer = setInterval(() => {
			// 	this.checkValidation();
			// }, 1500);
			
			eventBus.$on('progress', (photoObject, e) => {
				this.updateVideoUploadProgress(photoObject, e);
				this.updateOverallProgress();
			});

			eventBus.$on('finished', (photoObject, e) => {
				photoObject.uploading = false;
				photoObject.finished = true;
				photoObject.loading = false;
			});

			eventBus.$on('failed', (photoObject, e) => {
				photoObject.failed = true;
			});

		},

		methods: {
			loadTowRecord(){
				axios.get('/tows/' + this.towid)
					 .then((response) => {
					 	var tow = response.data;

					 	this.id = tow.id;
					 	this.tow_time = tow.tow_time;
					 	this.vehicle_owner = tow.vehicle_owner;
					 	this.parent_id = tow.parent_id;
					 	this.phone = tow.phone;
					 	this.tow_number = tow.tow_number;
					 	this.location = tow.location;
					 	this.make = tow.make;
					 	this.model = tow.model;
					 	this.year = tow.year;
					 	this.vehicle_color = tow.vehicle_color;
					 	this.time = tow.time;
					 	this.state = tow.state;
					 	this.tag_number = tow.tag_number;
					 	this.vin = tow.vin;
					 	this.mileage = tow.mileage;
					 	this.officer_id = tow.officer_id;
					 	this.complaint_number = tow.complaint_number;
					 	this.tags =  (tow.tags != null) ? tow.tags.split(',') : "" ;
					 	this.children = tow.children;
					 	this.photos = tow.photos;
					 	this.lot_id = parseInt(tow.lot_id);
					 	
					 	console.log(tow.tags);

					 	var $this = this;
					 	
					 	$(this.$refs.tgs).selectize({
						    persist: false,
						    maxItems: 100,
						    items: this.tags,
						    onChange(value){
						    	$this.updateTags(value);
						    }
						});

					 },(err) => {

					 });
			},
			updateTowRecord(){
				this.saveStatus = "Saving Record...";
				console.log(this.tags);
				axios.put('/tows/' + this.id, {
					vehicle_owner: this.vehicle_owner,
					phone: this.phone,
					tow_number: this.tow_number,
					location: this.location,
					make: this.make,
					model: this.model,
					year: this.year,
					vehicle_color: this.vehicle_color,
					time: this.time,
					state: this.state,
					tag_number: this.tag_number,
					vin: this.vin,
					mileage: this.mileage,
					officer_id: this.officer_id,
					complaint_number: this.complaint_number,
					tags: this.tags,
					lot_id: this.lot_id
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

			storeMetaData(photo){
				var photoObject = this.genPhotoObject(photo);

				return new Promise((resolve, reject) => {
					axios.post('/tows/' + this.towid + '/photos', {
						extension: photoObject.photo.name.split('.').pop()
					}).then((response) => {
						photoObject.id = response.data.id;

						resolve(photoObject);
					},() => {
						reject(photoObject);
					});
				});
			},

			genPhotoObject(photo){
				var index = this.photos.push({
					id: null,
					tow_id: null,
					filename: null,
					notes: null,
					photo: photo,
					finished: false,
					uploading: false,
					loading: true
				}) - 1;

				return this.photos[index];
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
				var photos = this.$refs.photos.files;
				var photo;

				for(var i = 0; i < photos.length; i++){
					photo = photos[i];

					this.storeMetaData(photo)
						.then((photoObject) => {
							this.upload(photoObject);
						});
				}
			},

			upload(photoObject){
				var form = new FormData();
				
				photoObject.uploading = true;

				form.append('photo', photoObject.photo);
				form.append('extension', photoObject.photo.name.split('.').pop());

				axios.post('/photos/' + photoObject.id +'/upload', form).then((response) => {
					photoObject.filename = response.data.filename;
					photoObject.fullpath = response.data.fullpath;
					eventBus.$emit('finished', photoObject);
				}, () => {
				 	eventBus.$emit('failed', photoObject);
				});
			},			

			addChild(){
				axios.post('/tows/' + this.id + '/children',{})
					 .then((response) => {
					 	var tow = response.data;
					 	console.log(tow);
					 	this.children.push(tow);
					 },() => {

					 }); 
			},

			loadTags(){
				axios.get('/tags')
					.then((response) => {
						console.log(response.data);
						this.tlist = response.data;
					});
			},
			updateTags(t){
				this.tags = t;
			},

			checkValidation(){
				axios.get('/tows/' + this.id + '/valid')
					 .then((response) => {
					 	this.valid = response.data.tow_validated
					 });
			},

			confirmRemove(){

				if(confirm('Are you sure you want to delete?')){
					console.log('Remove');

					axios.delete('/tows/' + this.id)
						 .then((response) => {
						 	eventBus.$emit('removeChildTow', this.towindex);
						 });
				}

			}
		}
	}
</script>