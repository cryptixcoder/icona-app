<template>
	<button class="btn pull-left" :class="classObject" @click.prevent="toggleArchive()" >{{ archiveText }}</button>
</template>
<script>
	export default {
		props: ['towid'],
		
		data(){
			return {
				archived: false
			}
		},

		mounted(){
			console.log(this.towid);
			this.loadTow();
		},

		computed: {
			classObject: function () {
			    return {
			      'btn-default' : this.archived == false,
			      'btn-danger' : this.archived == true
			    }
			},

			archiveText: function(){
				return (this.archived == true) ? "Archived" : "Archive";
			}
		},

		methods: {
			loadTow(){
				axios.get('/tows/' + this.towid)
					.then((response) => {
						console.log(response.data);
						this.archived = response.data.archived;
					});
			},

			toggleArchive(){
				axios.post('/tows/' + this.towid + '/archive')
					 .then((response) => {
					 	this.archived = response.data.archived;
					 });
			}
		}
	}
</script>