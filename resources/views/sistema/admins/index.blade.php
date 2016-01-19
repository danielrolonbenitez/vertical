@extends('sistema.layouts.default')

@section('modal')
<!-- Modal para solicitar confirmacion antes de eliminar un Usuario -->
<div class="modal" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('admins.destroy', ''))) !!}
      {!! csrf_field() !!}
      <div class="modal-header text-center">
        ¿Esta seguro que desea realizar esta operación?
      </div>
      <div class="modal-body text-center">
        <input id="unidad_id" name="unidad_id" type="hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        {!! Form::submit('Aceptar', array('class' => 'btn btn-primary col-md-offset-1')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop

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
        <form method="GET" id="search-form" action="{{ route('admins.index') }}">
          <div class="pull-left">
            <label style="font-size:20px;margin-bottom: 0px">Administradores</label>
          </div>
          <div class="pull-right" style="padding-left:10px;">
            <a href="{{ route('admins.create') }}" class="btn btn-sm btn-success create" data-toggle="tooltip" data-placement="bottom" title="Agregar"><span class="glyphicon glyphicon-plus"></span></a>
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
                <a href="{{ route('admins.index') }}?sortby=id&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">ID</a>
              </th>
              <th>
                <a href="{{ route('admins.index') }}?sortby=razon_social&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Razón Social</a>
              </th>
              <th class="hidden-xs">
                <a href="{{ route('admins.index') }}?sortby=cuit&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">CUIT</a>                 
              </th>
              <th class="col-md-3 hidden-xs hidden-sm hidden-md">
                <a href="{{ route('admins.index') }}?sortby=domicilio&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Domicilio</a>                 
              </th>
              <th class="hidden-xs">
                <a href="{{ route('admins.index') }}?sortby=estado&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Estado</a>                    
              </th>
              <th>
                <a>Operaciones</a>
              </th>
            </tr>
          </thead>       
          <tbody>
            @if (count($admins)!=0)
            @foreach ($admins as $admin)
            <tr>
              <td class="admin_i col-md-1">{{ $admin->id }}</td>
              <td>{{ $admin->razon_social }}</td>
              <td class="hidden-xs">{{ $admin->cuit }}</td>
              <td class="col-md-3 hidden-xs hidden-sm hidden-md">{{ $admin->domicilio }}</td>
              <td class="hidden-xs">
                @if ( $admin->estado == 1 ) Activo @endif
                @if ( $admin->estado == 0 ) Inactivo @endif   
              </td>
              <td>
                <a href="{{ route('admins.index') }}/{{ $admin->id }}" class="btn btn-xs btn-info" title="Detalle"><span class="glyphicon glyphicon-info-sign"></span></a>
                <button class="btn btn-xs btn-danger delete" data-toggle="modal" data-target="#DeleteModal" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
              </td>
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
{!! $admins->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search])->render() !!}
@stop

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/AdminsOperations.js') }}"></script>
@stop