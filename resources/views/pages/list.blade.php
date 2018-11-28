<h2>Запчастини</h2>
<div class="list-group">
	@if(isset($prods))
		@foreach($prods as $prod)
	  	<button
	  	type="button"
	  	class="list-group-item list-group-item-action {{$prod->carmodels->isEmpty()?'':'my-list'}}"
	  	onclick="$('#{{$prod->id}}prod').toggleClass('d-none');">
	    	{{$prod->name}}
	    </button>
	    	@if(!$prod->carmodels->isEmpty())
	    	<ul id="{{$prod->id}}prod" class="d-none">
	    		@foreach($prod->carmodels as $carmodel)
	    		<li class="my-list-type">
	    			@if (!$carmodel->getDescs($prod->id)->isEmpty())
	    				<a href="{{route('show', [$carmodel->mark->name, $carmodel->name, $prod->id])}}">
	    					для {{$carmodel->mark->name . ' ' . $carmodel->name}}</a>
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