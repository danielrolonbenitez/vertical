@extends('inquilino.layouts.default')

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
  {!! Form::model(Auth::user(), array('route' => array('perfil.update', Auth::user()->id ), 'method' => 'PATCH', 'data-toggle' => 'validator')) !!}
  {{ csrf_field() }}
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Editar Mi Cuenta</h2>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-sm-6 has-feedback">
          <label class="col-sm-4 control-label" for="nombre">Nombre</label> 
          <div class="col-sm-8"> 
            <input autocomplete="off" value="{{ Auth::user()->nombre }}" required id="nombre" name="nombre" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-sm-6 has-feedback">
          <label class="col-sm-4 control-label" for="apellido">Apellido</label> 
          <div class="col-sm-8">  
            <input autocomplete="off" value="{{ Auth::user()->apellido }}" required id="apellido" name="apellido" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6 has-feedback">
          <label class="col-sm-4 control-label" for="email">Email</label> 
          <div class="col-sm-8"> 
            <input data-remote="{{ route('validate.usuarioemail') }}" data-remote-error="*Email registrado" value="{{ Auth::user()->email }}" required id="email" name="email" class="form-control" type="email" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-sm-6 has-feedback">
          <label class="col-sm-4 control-label" for="rol">Rol</label> 
          <div class="col-sm-8">  
            <input disabled required value="{{ $rol }}" id="rol" name="rol" class="form-control" type="text" maxlength="10" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div> 
      </div>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="row">
      <button type="submit" class="pull-right btn btn-primary">Guardar</button>
      <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
    </div>
  </div>
  {!! Form::close() !!}
</div>
@stop
