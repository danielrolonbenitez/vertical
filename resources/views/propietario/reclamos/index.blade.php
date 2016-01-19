@extends('propietario.layouts.default')

@section('content')
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
   <div class="tab-content">
    <div class="tab-pane active">
      <div class="panel-primary col-xs-12"> 
      <div class="panel-heading col-xs-12 form-inline">
        <form method="GET" id="search-form" action="{{ route('reclamos.index') }}">
          <div class="pull-left">
            <label style="font-size:20px;margin-bottom: 0px">Reclamos</label>
          </div>
          <div class="pull-right" style="padding-left:10px;">
            <a href="{{ route('reclamos.create') }}" class="btn btn-sm btn-success create" data-toggle="tooltip" data-placement="bottom" title="Agregar"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
          <button class="pull-right btn btn-sm btn-default" type="submit" ><span class="glyphicon glyphicon-search"></span></button>
          <div class="form-group form-group-xm pull-right">
            <input style="height:30px;" name="search" id="search" type="text" class="form-control" placeholder="Buscar">
          </div>
        </form>
      </div>
      <div class="panel-body col-xs-12">
      <table class="table table-hover">
          <thead>
            <tr class="filters">
              <th class="col-md-1">
                <a href="{{ route('reclamos.index') }}?sortby=reclamos.id&order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Número</a>
              </th>
              <th>
                <a href="{{ route('reclamos.index') }}?sortby=titulo&order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Título</a>
              </th>
              <th>
                <a >Unidad</a>
              </th>
              <th>
                <a href="{{ route('reclamos.index') }}?sortby=razon_social&order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Edificio</a>                 
              </th>
              <th>
                <a href="{{ route('reclamos.index') }}?sortby=roles.nombre&order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Grupo</a>                 
              </th>
              <th>
                <a href="{{ route('reclamos.index') }}?sortby=estado&order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Estado</a>                    
              </th>
            </tr>
          </thead>       
          <tbody>
            @if (count($reclamos)!=0)
              @foreach ($reclamos as $reclamo)
              <tr>
                <td class="col-md-1"><strong><a href="{{ route('reclamos.show', $reclamo->id) }}">{{ $reclamo->id }}</a></strong></td>
                <td >{{ $reclamo->titulo }}</td>
                <td >{{ $reclamo->numero }}{{ $reclamo->letra }}</td>
                <td >{{ $reclamo->razon_social }}</td>
                <td >{{ $reclamo->nombre }}</td>
                <td >{{ $reclamo->estado }}</td>
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
{!! $reclamos->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search])->render() !!}
@stop