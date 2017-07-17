<template>
	<div class="photo col-md-3 col-sm-12 col-xs-12">
		<a href="#" data-toggle="modal" :data-target="phototarget"  >
			<img :src="fullpath" :alt="notes" v-show="!photo.loading" />
		</a>
		<div class="uploading-photo" v-show="photo.loading">
			<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
		</div>
		<div class="modal fade" :class="photoclass" role="dialog" ref="input">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Notes</h4>
		      </div>
		      <div class="modal-body">
				<div class="form-group">
					<div class="form-group">
						<img :src="fullpath" alt="">
					</div>
					<div class="form-group">
						<label>Notes</label>
						<textarea v-model="notes" style="resize: none;" cols="30" rows="10" class="form-control"></textarea>
					</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" @click.prevent="saveNotes()">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>

</template>
<script>
	import eventBus from '../events.js';

	export default {
		props: [
			'photo'
		],

		data(){
			return {
				filename: "",
				notes: "",
				fullpath: "",
				show: false,
				photoclass: "",
				phototarget: ""
			}
		},

		mounted(){
			//this.fetchNotes();

			this.filename = this.photo.filename;
			this.notes = this.photo.notes;
			this.fullpath = this.photo.fullpath;
			this.photoclass = "photo_" + this.photo.id;
			this.phototarget = "." + this.photoclass;
			

			eventBus.$on('finished', (photoObject, e) => {
				
				if(this.photo.id == photoObject.id){
					this.fullpath = photoObject.fullpath;
					this.photoclass = "photo_" + this.photo.id;
					this.phototarget = "." + this.photoclass;
				}
	
			});
		
			this.$refs.input.modal();
		},

		methods: {
			open(){
				this.show = true;
			},

			fetchNotes(){
				axios.get('/photos/' + this.photo.id)
					 .then((response) => {
					 	this.filename = response.data.filename;
					 	this.fullpath = response.data.fullpath;
					 	this.notes = response.data.notes;
					 });
			},

			saveNotes(){
				axios.post('/photos/' + this.photo.id, {
					notes: this.notes
				})
				.then((response) => {

				});
			},

			close(){
				this.show = false;
			}
		}
	}
</script>