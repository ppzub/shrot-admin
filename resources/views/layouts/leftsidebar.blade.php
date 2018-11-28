<div class="sidebar left ">
  <ul class="list-sidebar bg-defoult">
    <li> <a href="{{route('index')}}"><span class="nav-label">Автомобілі</span></a> </li>
    <li> <a href="{{route('prodlist')}}"><span class="nav-label">Запчастини</span></a> </li>
    <li> <a href="#" data-toggle="collapse" data-target="#dashboard" class="collapsed active">
      <span class="nav-label"> Додати </span>
      <span class="fa fa-chevron-right pull-right"></span> </a>
      <ul class="sub-menu collapse" id="dashboard">
        <li><a href="{{route('addmodel')}}">Модель авто</a></li>
        <li><a href="{{route('addprod')}}">Назву запчастини</a></li>
        <li><a href="{{route('add')}}">"Модель" запчастини</a></li>
      </ul>
    </li>
    <li> <a href="#" data-toggle="collapse" data-target="#dashboard2" class="collapsed active">
      <span class="nav-label"> Видалити </span>
      <span class="fa fa-chevron-right pull-right"></span> </a>
      <ul class="sub-menu collapse" id="dashboard2">
        <li><a href="{{route('deleteprod')}}">Застосування</a></li>
        <li><a href="{{route('removeprod')}}">Товар</a></li>
      </ul>
    </li>
  </ul>
</div>