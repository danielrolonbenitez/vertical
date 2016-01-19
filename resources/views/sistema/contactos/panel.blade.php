@extends('sistema.layouts.default')

@section('modal')
<!-- Modal para solicitar confirmacion antes de eliminar un Mensaje -->
<div class="modal" id="UserDeleteModal" tabindex="-1" role="dialog" aria-labelledby="UserDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('contactos.destroy', ''))) !!}
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

<!-- Modal para ver  mensajes y cambiar estado a leido -->
<div class="modal" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="UserDeleteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="EditForm" method="get" action="{{action('ContactosController@edit') }}">
        <input type="hidden" id="idm" name="id" />
        {!! csrf_field() !!}
        <div class="modal-header">
          <div class="form-group">
            {!! Form::label('De:', null, array('class' => 'col-sm-3 control-label')) !!}
            <span id='mensaje_email'></span>
          </div>
          <div class="form-group">
            {!! Form::label('Asunto:', null, array('class' => 'col-sm-3 control-label')) !!}
            <span id='mensaje_asunto'></span>
          </div>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <span id='mensaje_name'></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <input type="submit" value='Leido' class= 'btn btn-primary'>
        </div>
      </form>
    </div>
  </div>
</div>
@stop

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
        <form method="GET" id="search-form" action="{{ route('contactos.index') }}">
          <div class="pull-left">
            <label style="font-size:20px;margin-bottom: 0px">Mensajes</label>
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
                <a href="{{ route('contactos.index') }}?sortby=id&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">ID</a>                   
              </th>
              <th class="hidden-xs">
                <a href="{{ route('contactos.index') }}?sortby=nombre&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Nombre</a>
              </th>
              <th class="hidden-xs">
                <a href="{{ route('contactos.index') }}?sortby=apellido&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Apellido</a>                 
              </th>
              <th>
                <a href="{{ route('contactos.index') }}?sortby=email&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Email</a>
              </th>
              <th>
                <a href="{{ route('contactos.index') }}?sortby=estate&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Estado</a>                    
              </th>
              <th>
                <a>Operaciones</a>
              </th>
            </tr>
          </thead>       
          <tbody>
            @if (count($mensaje)!=0)
            @foreach ($mensaje as $mensajes)
            <tr>
              <td class="user_i col-md-1">{{ $mensajes->id }}</td>
              <td class="user_n hidden-xs">{{ $mensajes->nombre }}</td>
              <td class="user_l hidden-xs">{{ $mensajes->apellido }}</td>
              <td class="user_e">{{ $mensajes->email }}</td>
              <td class="user_r">{{ $mensajes->estate }}</td>
              <td class="men" style="display:none">{{ $mensajes->mensaje }}</td>
              <td>
                <button class="btn btn-xs btn-info edit" data-toggle="modal" data-target="#EditModal" title="Ver Mensajes"><span class="glyphicon glyphicon-info-sign"></span></button>
                <button class="btn btn-xs btn-danger delete" data-toggle="modal" data-target="#UserDeleteModal" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
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
{!! $mensaje->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search])->render() !!}
@stop

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/ContactoOperations.js') }}"></script>
@stop
