<template>
<div class="row">
	<div class="col-sm-auto">
		<form @submit.prevent="send()" enctype="multipart/form-data">
			<!--Вибір машини і назви товару -->
			<span>Обов'язково оберіть авто і запчастину до нього!</span><br>
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
					<select v-if="getmodels.length != 0 && getproducts.length != 0" v-model="selectedProduct">
						<option disabled value="">Оберіть запчастину</option>
						<option v-for="prod in getproducts" :value="prod.name" @click="getProdId(prod.name)">
				    		{{ prod.name }}
				  		</option>
					</select>
					<br><br>
			<div class="form-group">
			<label class="control-label" for="textarea">Примітки:</label><br>
				<textarea rows="1" cols="32" v-model="desc.note"></textarea>
			</div>
			<div class="form-group">
				<label class="control-label">Image</label>
		        <input type="file" @change="onImageChange" accept="image/*">
					<div v-if="desc.image.length > 0">
				        <img class="preview" :src="desc.image">
				    </div>
			</div>
		    <div class="form-group">
			    <label class="control-label">YouTube Video ID: <br>https://www.youtube.com/watch?v=
			    	<span class="badge badge-dark">ThisIsYouId</span></label>
		        <input type="text" v-model="desc.video" class="form-control">
		    </div>
		    <div class="form-group">
		    	<label class="control-label">Статус: </label>
		    	<input type="radio" id="old" value="б/в" v-model="desc.status">
				<label for="old">б/в</label>
				<input type="radio" id="new" value="нова" v-model="desc.status">
				<label for="new">нова</label>
		    </div>
		    <div class="form-group">
		    	<label class="control-label">Ціна: </label>
		    	<input type="text" v-model="desc.price">
		    </div>
		    <div class="form-group">
		    	<label class="control-label">Продано: </label>
				<input type="radio" id="no" value="0" v-model="desc.sold">
				<label for="no">Ні</label>
		    	<input type="radio" id="yes" value="1" v-model="desc.sold">
				<label for="yes">Так</label>
		    </div>
		    <button v-if="selected && selectedModel && selectedProduct" type="submit" class="btn btn-dark">Зберегти</button>
		</form>
	</div>
</div>
</template>
<style>
    img.preview {
        width: 200px;
        background-color: white;
        border: 1px solid #DDD;
        padding: 5px;
    }
</style>
<script>
	export default {
		props: [
			'marks'
		],
		data() {
		    return {
		    	desc: {
			    	note: '',
			    	image: '',
			    	video: '',
			    	status: 'б/в',
			    	price: 0,
			    	sold: 0,
			    	product_id: '',
			    	carmodel_id: '',
			    },
			    selected: '',
		        selectedModel: '',
		        selectedProduct: '',
		        getmodels: [],
		        getproducts: [],
		    }
		},

		methods: {
			onImageChange(event){
                var input = event.target;
                // Ensure that you have a file before attempting to read it
                if (input.files && input.files[0]) {
                    // create a new FileReader to read this image and convert to base64 format
                    var reader = new FileReader();
                    // Define a callback function to run, when FileReader finishes its job
                    reader.onload = (e) => {
                        // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                        // Read image as base64 and set to imageData
                        this.desc.image = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
                }
			},
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
					this.desc.carmodel_id = this.getmodels[i].id;
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
		getProdId(name) {
			for (var i = 0; i < this.getproducts.length; i++) {
				if (name == this.getproducts[i].name) {
					this.desc.product_id = this.getproducts[i].id
				}
			}
		},
		send() {
				axios.post('/products/' + this.selected + '/' + this.selectedModel + '/' + this.desc.product_id, this.desc)
				  .then((response) => {
				    console.log(response);
				    const status = JSON.parse(response.status);

				      //redirect logic
				      	if (status == '201') {
				      		window.alert('Успішно створено "модель" товару!');
				      	}

				  })
				  .catch((error) => {
				    console.log(error);
				  });
			},
		}
	}
</script>