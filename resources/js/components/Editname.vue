<template>
	<div>
		<h5 class="card-title left">{{name}}</h5>
		<a href="#" v-on:click.prevent="showForm()">Змінити назву
			<span class="fa fa-chevron-down pull-right"></span>
		</a>
		<form v-if="this.show" @submit.prevent="editName()">
			Нова назва: <input type="text" v-model="name">
			<button type="submit" class="btn btn-dark">Зберегти</button>
		</form>
	</div>
</template>

<script>
	export default {
		props: [
			'product_id'
		],
		data() {
		    return {
		        name: '',
		        show: 0,
		    }
		},
		mounted() {
			this.getName();
		},
		methods: {
			showForm() {
				if (!this.show)	{
					this.show = 1;
				}
				else {
					this.show = 0;
				}
			},
			editName() {
				axios.put('/editname', {id: this.product_id, new: this.name})
				  .then((response) => {
				    console.log(response);
				    const status = JSON.parse(response.status);

				      //redirect logic
				      	if (status == '200') {
				      		window.alert('Успішно збережено!');
				      	}
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			},

			getName() {
				axios.get('/getname/' + this.product_id)
				  .then((response) => {
				    console.log(response);
				    this.name = response.data;
				  })
				  .catch((error) => {
				    console.log(error);
				  });
			}

		}
	}
</script>