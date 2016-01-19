@extends('propietario.layouts.default')

@section('content')
<div class="tab-content">
  @if (Session::get('alert') == 1)
  <div class="alert-group">
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Información</strong> La operación se ha realizado con éxito.
    </div>
  </div>
  @endif
  @if (count($errors) > 0)
  <div class="alert-group">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      @foreach ($errors->all() as $error)
      {{ $error }}</br>
      @endforeach
    </div>
  </div>
  @endif
  @if ( isset($_GET["order"]) && str_is($_GET["order"],'asc'))
  <?php $order="desc" ?>
  @else
  <?php $order="asc" ?>
  @endif
  <div class="tab-pane active">
    <div class="panel-primary col-xs-12">  
      <div class="panel-heading col-xs-12 form-inline">
        <form method="GET" id="search-form" action="{{ route('gastos.index', ['id' => $edificio_id ]) }}">
          <div class="pull-left">
            <label style="font-size:20px;margin-bottom: 0px">Gastos</label>
          </div>
          <button class="pull-right btn btn-sm btn-default" type="submit" ><span class="glyphicon glyphicon-search"></span></button>
          <div class="form-group form-group-xm pull-right">
            <input type="hidden" name="id" id="id" value="{{ $edificio_id }}"> 
            <input style="height:30px;" name="search" id="search" type="text" class="form-control" placeholder="Buscar">
          </div>
        </form>
      </div>
      <div class="panel-body col-xs-12">
        <table class="table table-hover">
          <thead>
          <tr>
              <th class="col-md-1">
                <a href="{{ route('gastos.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=id&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">ID</a>
              </th>
              <th class="col-md-2">
                <a href="{{ route('gastos.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=fecha&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Fecha</a>
              </th>
              <th>
                <a href="{{ route('gastos.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=descripcion&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Descripción</a>                 
              </th>
              <th class="col-md-2 hidden-xs hidden-sm">
                <a href="{{ route('gastos.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=comprobante&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Comprobante</a>                 
              </th>
              <th class="col-md-1">
                <a href="{{ route('gastos.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=importe&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Importe</a>                 
              </th>
            </tr>
          </thead>       
          <tbody>
            @if (count($gastos)!=0)
            @foreach ($gastos as $gasto)
            <tr>
              <td class="gasto_i col-md-1">{{ $gasto->id }}</td>
              <td class="gasto_f col-md-2">{{ $gasto->fecha }}</td>
              <td class="gasto_d">{{ $gasto->descripcion }}</td>
              <td class="hidden-xs hidden-sm col-md-2">{{ $gasto->comprobante }}</td>
              <td class="col-md-1">${{ $gasto->importe }}</td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="12" align="center">No se encontraron registros.</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@if ( isset($_GET["sortby"]) )
<?php $sortby=$_GET["sortby"] ?>
@else
<?php $sortby="id" ?>
@endif
@if ( isset($_GET["order"]) )
<?php $order=$_GET["order"] ?>
@else
<?php $order="asc" ?>
@endif
@if ( isset($_GET["search"]) )
<?php $search=$_GET["search"] ?>
@else
<?php $search="" ?>
@endif
{!! $gastos->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search, 'id' => $edificio_id])->render() !!}
@stop