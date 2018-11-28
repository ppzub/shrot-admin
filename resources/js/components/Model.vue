<template>
	<div>
	<form @submit.prevent="setCarModel()">
	Назва: <input type="text" v-model="name">
	Авто: <select v-model="selected">
		<option disabled value="">Оберіть автомобіль</option>
		<option v-for="mark in marks" :value="mark">
    		{{ mark }}
  		</option>
	</select>
	<input v-if="name != 0 && selected != 0" type="submit" value="додати" class="btn btn-dark">
	</form>
	<div v-for="item, index in carmodels">
	<span>
		{{item.marka + ' ' + item.model}}
		<a href="#" @click.prevent="deleteCarModel(index)"><i class="fas fa-times-circle"></i></a>
	</span>
	</div>
	<div v-if="carmodels.length != 0">
		<button @click="send()" class="btn btn-dark">Зберегти</button>
	</div>
</div>
</template>

<script>
	export default {
		props: [
			'marks'
		],
		data() {
		    return {
		        name: '',
		        carmodels: [],
		        selected: ''
		    }
		},

		methods: {
			setCarModel() {
				this.carmodels.push({model: this.name, marka: this.selected});
			},
			deleteCarModel(index) {
				this.carmodels.splice(index, 1);
			},
			send() {
				axios.post('/createmodel', this.carmodels)
				  .then((response) => {
				    console.log(response);
				    const status = JSON.parse(response.status);

				      //redirect logic
				      	if (status == '200') {
				      		window.alert('Успішно збережено!');
				       		window.location = "/";
				      	}
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			}
		}
	}
</script>