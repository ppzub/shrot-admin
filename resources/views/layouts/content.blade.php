@if(isset($addmodel))
	@include('pages.addmodel')
@elseif(isset($avtos))
	@include('pages.avto')
@elseif(isset($prods))
	@include('pages.list')
@elseif(isset($deleteprod))
	@include('pages.deleteprod')
@elseif(isset($removeprod))
	@include('pages.removeprod')
@elseif(isset($addprod))
	@include('pages.addprod')
@elseif(isset($showprod))
	@include('pages.showprod')
@elseif(isset($add))
	@include('pages.add')
@elseif(isset($show))
	@include('pages.show')
@elseif(isset($edit))
	@include('pages.edit')
@endif
