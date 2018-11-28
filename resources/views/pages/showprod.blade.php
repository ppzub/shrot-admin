<h2>Запчастини до {{$marka}} {{$model}}</h2>
@foreach($products as $product)
	@if($product->published)
		<div class="card">
		    <div class="card-body">
		        <editname :product_id="{{json_encode($product->id)}}"></editname><br>
		        @if($product->desc)
		        	<p class="card-text">{{$product->desc}}</p>
		        @endif
		    <a href="{{route('show', [$marka, $model, $product->id])}}" class="btn btn-dark">
				<span class="nav-label"> Всі "моделі" </span>
      			<span class="fa fa-chevron-right pull-right"></span>
			</a>
			</div>
		</div>
	@endif
@endforeach