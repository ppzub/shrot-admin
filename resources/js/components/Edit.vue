<template>
<div class="row">
	<div class="col-sm-auto">
		<form @submit.prevent="send()" enctype="multipart/form-data">
			<div class="form-group">
			<label class="control-label" for="textarea">Примітки:</label><br>
				<textarea rows="1" cols="32" v-model="desc.note"></textarea>
			</div>
			<div class="form-group">
				<label class="control-label">Image</label>
		        <input type="file" @change="onImageChange" accept="image/*">
					<div v-if="!isJson(desc.image)">
                        <img class="preview" :src="desc.image" width="120px">
                    </div>
                    <div v-if="desc.image_src.length > 0 && isJson(desc.image)">
                        <img class="preview" :src="desc.image_src">
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
		    <button type="submit" class="btn btn-dark">Зберегти</button>
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
			'arr'
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
			    	image_src: '',
			    }
		    }
		},
		mounted() {
			this.getDesc();
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
		getDesc() {
				axios.get('/getdesc/' + this.arr.desc_id)
				.then((response) => {
				    console.log(response);
				    this.desc = response.data;
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			},
		send() {
				axios.put('/update/product/' + this.arr.desc_id, this.desc)
				  .then((response) => {
				    console.log(response);
				    const status = JSON.parse(response.status);

				      //redirect logic
				      	if (status == '200') {
				      		window.alert('Успішно оновлено "модель" товару!');
				      	}

				  })
				  .catch((error) => {
				    console.log(error);
				  });
			},
		isJson(str) {
                try {
                    JSON.parse(str);
                } catch (e) {
                    return false;
                }
                return true;
            }
		}
	}
</script>