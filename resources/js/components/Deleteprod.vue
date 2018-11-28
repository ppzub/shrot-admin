<template>
<div class="row">
	<div class="col-sm-auto">
			<select v-model="selected">
				<option disabled value="">Оберіть автомобіль</option>
				<option v-for="mark in marks" :value="mark" @click="getModels(mark)">
		    		{{ mark }}
		  		</option>
			</select>
				<select v-if="getmodels.length != 0" v-model="selectedModel">
					<option disabled value="">Оберіть його модель</option>
					<option v-for="model in getmodels" :value="model.name" @click="getProducts(model.name)">
			    		{{ model.name }}
			  		</option>
				</select>
			<ul class="list-group my-right-list" v-for="prod, index in getproducts">
			  	<li class="list-group-item">{{ prod.name }}
			  		<a href="#" v-on:click.prevent="remove(prod.id, index)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
			  	</li>
			</ul>

	</div>
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
			'marks'
		],
		data() {
		    return {
			    selected: '',
		        selectedModel: '',
		        getmodels: [],
		        getproducts: [],
		        ids : {
			        carmodel_id: '',
			        product_id: ''
			    }
		    }
		},

		methods: {
		getModels(mark) {
				axios.get('/getmodels/' + mark + '/fordesc' )
				.then((response) => {
				    console.log(response);
				    this.getmodels = response.data;
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			},
		getProducts(model) {
			//get carmodel_id
			for (var i = 0; i < this.getmodels.length; i++) {
				if (model == this.getmodels[i].name) {
					this.ids.carmodel_id = this.getmodels[i].id;
				}
			}
				axios.get('/getproducts/' + model)
				.then((response) => {
				    console.log(response);
				    this.getproducts = response.data;
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			},

		remove(id, index) {
			if (confirm("Дійсно видалити це застосування до авто?")) {
			this.ids.product_id = id;
				axios.post('/deleteprod', this.ids)
				.then((response) => {
				    console.log(response);

				    const status = JSON.parse(response.status);
				      	this.getproducts.splice(index, 1);
				  })
				  .catch((error) => {
				    console.log(error);
				  });
				}
			},
		}
	}
</script>