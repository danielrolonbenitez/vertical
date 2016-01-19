@extends('administrador.layouts.default')

@section('modal')
<!-- Modal para solicitar confirmacion antes de eliminar un Edificio -->
<div class="modal" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('edificios.destroy', ''))) !!}
      {!! csrf_field() !!}
      <div class="modal-header text-center">
        ¿Esta seguro que desea realizar esta operación?
      </div>
      <div class="modal-body text-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        {!! Form::submit('Aceptar', array('class' => 'btn btn-primary col-md-offset-1')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Modal para enviar notificacion a todos los dueños e inquilinos de un Edificio -->
<div class="modal" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="MessageModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'MessageForm', 'method' => 'DELETE', 'route' => array('edificios.message', ''))) !!}
      {!! csrf_field() !!}
      <div class="modal-header">
        Enviar Mensaje
      </div>
      <div class="modal-body">
        <div class="form-group">
          <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Este mensaje será enviado a los Propietarios e Inquilinos del Edificio." maxlength="140" rows="7"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        {!! Form::submit('Aceptar', array('class' => 'btn btn-primary')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop

@section('content')
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
<div class="tab-content">
  <img src="images/spin.gif" id="loading-indicator" style="display:none" />
  <div class="tab-pane active">
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <form method="GET" id="search-form" action="{{ route('edificios.index') }}">
          <div class="pull-left">
            <label style="font-size:20px;margin-bottom: 0px">Edificios</label>
          </div>
          <div class="pull-right" style="padding-left:10px;">
            <a href="{{ route('edificios.create') }}" class="btn btn-sm btn-success create" data-toggle="tooltip" data-placement="bottom" title="Agregar"><span class="glyphicon glyphicon-plus"></span></a>
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
            <tr>
              <th class="col-md-1">
                <a href="{{ route('edificios.index') }}?sortby=id&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">ID</a>
              </th>
              <th>
                <a href="{{ route('edificios.index') }}?sortby=razon_social&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Razón Social</a>
              </th>
              <th class="hidden-xs">
                <a href="{{ route('edificios.index') }}?sortby=cuit&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">CUIT</a>                 
              </th>
              <th class="hidden-xs hidden-sm hidden-md">
                <a href="{{ route('edificios.index') }}?sortby=direccion&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Domicilio</a>                 
              </th>
              <th class="hidden-xs">
                <a href="{{ route('edificios.index') }}?sortby=suterh&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">SUTERH</a>                    
              </th>
              <th>
                <a>Operaciones</a>
              </th>
            </tr>
          </thead>       
          <tbody>
            @if (count($edificios)!=0)
            @foreach ($edificios as $edificio)
            <tr>
              <td class="edificio_i col-md-1">{{ $edificio->id }}</td>
              <td>{{ $edificio->razon_social }}</td>
              <td class="hidden-xs">{{ $edificio->cuit }}</td>
              <td class="hidden-xs hidden-sm hidden-md">{{ $edificio->direccion }}</td>
              <td class="hidden-xs">{{ $edificio->suterh }}</td>
              <td>
                <a class="btn btn-xs btn-info" href="{{ route('edificios.index') }}/{{ $edificio->id }}"><span class="glyphicon glyphicon-info-sign" title="Informacion"></span></a> 
                <a class="btn btn-xs btn-success" href="{{ route('eventos.index') }}?id={{ $edificio->id }}"><span class="glyphicon glyphicon-calendar" title="Calendario"></span></a> 
                <a class="btn btn-xs btn-warning" href="{{ route('gastos.index') }}?id={{ $edificio->id }}"><span class="glyphicon glyphicon-usd" title="Gastos"></span></a>
                <a class="btn btn-xs btn-danger" href="{{ route('expensas.index') }}?id={{ $edificio->id }}"><span class="glyphicon glyphicon-file" title="Expensas"></span></a>
                <button class="btn btn-xs btn-warning message" data-toggle="modal" data-target="#MessageModal" data-toggle="tooltip" data-placement="bottom" title="Notificacion"><span class="glyphicon glyphicon-envelope"></span></button>               
                <button class="btn btn-xs btn-danger delete" data-toggle="modal" data-target="#DeleteModal" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
              </td>
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
{!! $edificios->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search])->render() !!}
@stop

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/EdificiosOperations.js') }}"></script>
@stop