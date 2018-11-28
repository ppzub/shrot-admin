<template>
<div>
	<ul class="list-group my-right-list" v-for="prod, index in tovars">
	  	<li class="list-group-item">{{prod.name}}
		  	<a href="#" v-on:click.prevent="removeprod(prod.id, index)" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
		  	</a>
	  	</li>
	</ul>
</div>
</template>
<style>
.my-right-list li a {
  float: right;
}
</style>
<script>
	export default {
		props: [
			'products'
		],
		data() {
		    return {
		    	product_id: '',
		    	tovars: this.products,
		    }
		},

		methods: {

		removeprod(id, index) {
			if (confirm("Дійсно видалити цей товар взагалі?")) {
			this.product_id = id;
				axios.delete('/removeprod/' + this.product_id)
				.then((response) => {
				    console.log(response);
				      	this.tovars.splice(index, 1);
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			}
		}
	}
}
</script>