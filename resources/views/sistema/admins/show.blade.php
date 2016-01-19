@extends('sistema.layouts.default')

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
    <div class="panel-heading col-xs-12 form-inline">
      <label style="font-size:20px;margin-bottom: 0px">Administrador</label>
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
        <label class=" col-md-4 control-label">Estado</label> 
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
  <div class="col-md-12" style="padding-right:0px">
     <a href="{{ route('admins.index') }}/{{ $admin->id }}/edit" class="pull-right btn btn-primary">Editar</a>
    <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
  </div>
</div>
@stop