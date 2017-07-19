<template>
	<button class="btn pull-left btn-default" :class="classObject" @click.prevent="toggleRelease()" >{{ releasedText }}</button>
</template>
<script>
	export default {
		props: ['towid'],

		mounted(){
			this.fetchTow();
		},

		data(){
			return {
				released: false
			}
		},

		computed: {
			classObject: function () {
			    return {
			      'btn-default' : this.released == false,
			      'btn-danger' : this.released == true
			    }
			},

			releasedText: function(){
				return (this.released == true) ? "Released" : "Stored";
			}
		},

		methods: {
			fetchTow(){
				axios.get('/tows/' + this.towid)
					 .then((response) => {
					 	this.released = response.data.released;
					 });
			},

			toggleRelease(){
				axios.post('/tows/' + this.towid + '/release')
					 .then((response) => {
					 	this.released = response.data.released;
					 });
			}
		}
	}

	//This will show up in the index page for only admins to mark as released
</script>

