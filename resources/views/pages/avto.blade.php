<h2>Автомобілі</h2>
<div class="list-group">
	@if(isset($avtos))
		@foreach($avtos as $avto)
	  	<button
	  	type="button"
	  	class="list-group-item list-group-item-action {{$avto->carmodels->isEmpty()?'':'my-list'}}"
	  	onclick="$('#{{$avto->id}}marka').toggleClass('d-none');">
	    	{{$avto->name}}
	    </button>
	    	@if(!$avto->carmodels->isEmpty())
	    	<ul id="{{$avto->id}}marka" class="d-none">
	    		@foreach($avto->carmodels as $carmodel)
	    		<li class="my-list-type">
	    			@if (!$carmodel->products->isEmpty())
	    				<a href="{{route('showprod', [$carmodel->mark->name, $carmodel->name])}}">{{$carmodel->name}}</a>
	    			@else
	    				<span>{{$carmodel->name}}</span>
	    			@endif
	    		</li>
	    		@endforeach
	    	</ul>
	    	@endif
	  	@endforeach
  	@endif
</div>