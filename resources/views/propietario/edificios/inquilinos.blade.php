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
        <div class="pull-left">
          <label style="font-size:20px;margin-bottom: 0px">Inquilinos Disponibles</label>
        </div>
          <form method="GET" id="search-form" action="{{ route('unidad.inquilinos.show', $unidad_id) }}">
          {{ csrf_field() }}
          <button class="pull-right btn btn-sm btn-default" type="submit" ><span class="glyphicon glyphicon-search"></span></button>
          <div class="form-group form-group-xm pull-right">
            <input style="height:30px;" name="search" id="search" type="text" class="form-control" placeholder="Buscar">
          </div>
        </form>
      </div>
        <div class="panel-body col-xs-12">
  <form method="POST" action="{{ route('unidad.inquilinos.store', $unidad_id ) }}" >
    {{ csrf_field() }}
          <table class="table table-hover">
            <thead>
              <tr class="filters">
                <th>
                  <a href="{{ route('unidad.inquilinos.show', $unidad_id) }}?sortby=id&amp;order=<?php echo $order;if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">ID</a>
                </th>
                <th class="hidden-xs">
                  <a href="{{ route('unidad.inquilinos.show', $unidad_id) }}?sortby=nombre&amp;order=<?php echo $order;if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Nombre</a>
                </th>
                <th class="hidden-xs">
                  <a href="{{ route('unidad.inquilinos.show', $unidad_id) }}?sortby=apellido&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Apellido</a>                 
                </th>
                <th>
                  <a href="{{ route('unidad.inquilinos.show', $unidad_id) }}?sortby=email&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Email</a>                 
                </th>
                <th>
                  Seleccionar
                </th>
              </tr>
            </thead>       
            <tbody>
              <tr>
                <td>0</td>
                <td class="hidden-xs">Ninguno</td>
                <td class="hidden-xs">Ninguno</td>
                <td>Ninguno</td>
                <td><input type="radio" name="inquilino_id" value="null"></td>
              </tr>
              @if (count($users)!=0)
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td class="hidden-xs">{{ $user->nombre }}</td>
                <td class="hidden-xs">{{ $user->apellido }}</td>
                <td>{{ $user->email }}</td>
                <td><input type="radio" name="inquilino_id" value="{{ $user->id }}"></td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6" align="center">No se encontraron registros.</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12" style="padding-right:0px">
        <button type="submit" class="pull-right btn btn-primary">Guardar</button>
        <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
      </div>
    </form>
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
{!! $users->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search])->render() !!}
@stop