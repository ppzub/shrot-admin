<h2>{{$product->name}} до {{$marka}} {{$model}} в наявності</h2>
@if(count($descs) == 0)
	<h3>НЕМАЄ</h3>
@endif
@for($i=0, $j=2; $i<count($descs); $i++)
@if(($i == 0) || ($i%3 == 0))
	<div class="row">
@endif
    <div class="col-sm-auto">

    	<div class="card" style="width: 18rem;">
		  	<img class="card-img-top" src="{{$descs[$i]->getImage()->medium}}">
		  	<div class="card-body">
		    	<p class="card-text">{{$descs[$i]->note}}</p>
		    	<div class="embed-responsive embed-responsive-16by9 my-margin-bottom">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$descs[$i]->video}}" allowfullscreen></iframe>
				</div>
		  	</div>
		  	<ul class="list-group list-group-flush">
		    	<li class="list-group-item">Статус: {{$descs[$i]->status}}</li>
		    	<li class="list-group-item">Ціна: {{$descs[$i]->price}}</li>
		    	<li class="list-group-item">Продано: {{$descs[$i]->sold? 'так' : 'ні'}}</li>
		  	</ul>
		  	<div class="card-body">
		    	<form action="{{route('delete', $descs[$i]->id)}}" method="post">
		    		<a href="{{route('edit', [$marka, $model, $product->id, $descs[$i]->id])}}" class="btn btn-dark">Редагувати</a>
		    		{{ csrf_field() }}
    				{{ method_field('DELETE') }}
                    <button onclick="return(confirm('Дійсно видалити цей товар?'))" type="submit" class="btn btn-danger">
                    Видалити
                    </button>
                </form>
		  	</div>
		</div>

    </div>

@if (($i == $j) || ($i == count($descs) - 1))
	@php($j+=3)
	</div>
	<br>
@endif
@endfor