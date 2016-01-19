@extends('propietario.layouts.default')

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
        <label style="font-size:20px;">Usuario</label>
      </div>
    </div>
    <div class="panel-body col-xs-12">
        <div class="form-group col-md-6">
          <label class="col-md-offset-1 col-md-4 control-label">Nombre</label> 
          <div class="col-md-7"> 
            <p class="form-control">{{ $usuario->nombre }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Apellido</label> 
          <div class="col-md-7">  
            <p class="form-control">{{ $usuario->apellido }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-offset-1 col-md-4 control-label">Email</label> 
          <div class="col-md-7"> 
            <p class="form-control">{{ $usuario->email }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Rol</label> 
          <div class="col-md-7">  
            <p class="form-control">{{ $rol->nombre }}</p>
          </div>
        </div>
    </div>
  </div>
  <div class="col-xs-12" style="padding-right:0px">
    <a href="{{ route('users.index') }}/{{ $usuario->id }}/edit" class="pull-right btn btn-primary">Editar</a>
    <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
  </div>
</div>
@stop