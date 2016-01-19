@extends('administrador.layouts.default')

@section('content')
<div class="tab-content">
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
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12">
      <div class="pull-left">
        <h2 class="panel-title">Usuario</h2>
      </div>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Nombre</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $usuario->nombre }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Apellido</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $usuario->apellido }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Email</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $usuario->email }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Rol</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $rol->nombre }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if ( $rol->id == 2 )
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12">
      <h2 class="panel-title">Administración</h2>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Razón Social</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $admin->razon_social }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">CUIT</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->cuit }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Provincia</label> 
          <div class="col-md-8"> 
            <p class="form-control input-md">Buenos Aires</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Localidad</label> 
          <div class="col-md-8">  
            <p class="form-control">San Justo</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Domicilio</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $admin->domicilio }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Código Postal</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->cp }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Teléfono</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $admin->telefono }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Email</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->email }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Situación Fiscal</label> 
          <div class="col-md-8"> 
            <p class="form-control">Responsable Inscripto</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">R.P.A.</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->rpa }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Estado</label> 
          <div class="col-md-8">  
            <p class="form-control">
              @if ( $admin->estado == 1 ) Activo @endif
              @if ( $admin->estado == 0 ) Inactivo @endif
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  @if ( $rol->id == 3 || $rol->id == 4 )
  @if ( isset($_GET["order"]) && str_is($_GET["order"],'asc'))
  <?php $order="desc" ?>
  @else
  <?php $order="asc" ?>
  @endif
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Edificios</h2>
    </div>
    <div class="panel-body col-xs-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="col-md-1">
              <a href="{{ route('users.show', $usuario->id) }}?sortby=id&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">ID</a>
            </th>
            <th>
              <a href="{{ route('users.show', $usuario->id) }}?sortby=razon_social&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Razón Social</a>
            </th>
            <th class="hidden-xs">
              <a href="{{ route('users.show', $usuario->id) }}?sortby=cuit&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">CUIT</a>                 
            </th>
            <th class="hidden-xs hidden-sm hidden-md">
              <a href="{{ route('users.show', $usuario->id) }}?sortby=direccion&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Domicilio</a>                 
            </th>
            <th class="hidden-xs">
              <a href="{{ route('users.show', $usuario->id) }}?sortby=suterh&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">SUTERH</a>                    
            </th>
          </tr>
        </thead>       
        <tbody>
          @if (count($edificios)!=0)
          @foreach ($edificios as $edificio)
          <tr>
            <td class="edificio_i col-md-1">{{ $edificio->id }}</td>
            <td class="edificio_r">{{ $edificio->razon_social }}</td>
            <td class="edificio_c hidden-xs">{{ $edificio->cuit }}</td>
            <td class="edificio_d hidden-xs hidden-sm hidden-md">{{ $edificio->direccion }}</td>
            <td class="edificio_s hidden-xs">{{ $edificio->suterh }}</td>
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="5" align="center">No se encontraron registros.</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  @endif
  <div class="col-xs-12">
    <div class="row">
      <a href="{{ route('users.index') }}/{{ $usuario->id }}/edit" class="pull-right btn btn-primary">Editar</a>
      <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
    </div>
  </div>
</div>
@stop