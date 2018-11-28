<template>
	<div class="row">
		<div class="col-sm-auto">
			<form @submit.prevent="setProduct()">
			Назва товару: <input type="text" v-model="name"><br><br>
			<textarea rows="1" cols="32" v-model="desc" placeholder="опис товару"></textarea>
			</form>
			<span v-if="this.name">Застосувати {{this.name}} до:</span>
			<div v-for="item, index in models">
			<span>
				{{item.marka + ' ' + item.model}}
				<a href="#" @click.prevent="deleteModel(index)"><i class="fas fa-times-circle"></i></a>
			</span>
			</div>
			<div v-if="models.length != 0">
				<button @click="send()" class="btn btn-dark">Зберегти</button>
			</div>
		</div>
		<div class="col-sm-auto">
			<form @submit.prevent="setVars()">
			для авто: <select v-model="selected">
				<option disabled value="">Оберіть автомобіль</option>
				<option v-for="mark in marks" :value="mark" @click="getModels(mark)">
		    		{{ mark }}
		  		</option>
				</select>
				<select v-if="getmodels.length != 0" v-model="selectedModel">
					<option disabled value="">Оберіть його модель</option>
					<option v-for="model in getmodels" :value="model">
			    		{{ model }}
			  		</option>
				</select>
			<input v-if="name != 0 && selected != 0 && selectedModel != 0" type="submit" value="додати" class="btn btn-dark"><br><br>
			<label for="checkbox">Опублікувати</label>
			<input type="checkbox" id="checkbox" v-model="checked">

			</form>
		</div>
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
		        desc: '',
		        checked: 1,
		        selected: '',
		        selectedModel: '',
		        getmodels: [],
		        product: {},
		        models: []
		    }
		},

		methods: {
			setVars() {
				this.product = {
					name: this.name,
					desc: this.desc,
					published: this.checked,
				};
				this.models.push({
					marka: this.selected,
					model: this.selectedModel
				});
			},
			deleteModel(index) {
				this.models.splice(index, 1);
			},
			send() {
				axios.post('/createproduct', {product: this.product, models: this.models})
				  .then((response) => {
				    console.log(response);
				    const status = JSON.parse(response.status);

				      //redirect logic
				      	if (status == '200') {
				      		window.alert('Успішно додано товар!');
				       		window.location = "/";
				      	}
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			},
			getModels(mark) {
				axios.get('/getmodels/' + mark)
				.then((response) => {
				    console.log(response);
				    this.getmodels = response.data;
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			}
		}
	}
</script>