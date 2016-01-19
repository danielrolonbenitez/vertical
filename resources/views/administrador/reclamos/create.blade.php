@extends('administrador.layouts.default')

@section('content')
<div class="tab-content">
 @if (count($errors) > 0)
  <div class="alert-group">
    <div class="alert alert-danger alert-dimdissable">
      <button type="button" class="close" data-dimdiss="alert" aria-hidden="true">×</button>
      @foreach ($errors->all() as $error)
      {{ $error }}</br>
      @endforeach
    </div>
  </div>
  @endif
  <form method="POST" action="{{ route('reclamos.store') }}" data-toggle="validator">
    {{ csrf_field() }}
    <div class="panel panel-primary">
      <div class="panel-heading col-xs-12 form-inline" style="margin-bottom:20px;">
        <div class="pull-left">
          <label style="font-size:20px;margin-bottom: 0px">Nuevo Reclamo</label>
        </div>
      </div>
      <div class="form" style="background-color: white;padding-top:15px;">
        <div class="form-group col-md-6">
          <label class="col-md-offset-1 col-md-4 control-label" for="edificio">Edificio</label> 
          <div class="col-md-7"> 
            <input autocomplete="off" required id="edificio" name="edificio" class="form-control" type="text" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="unidad">Unidad</label> 
          <div class="col-md-7"> 
            <input autocomplete="off" required id="unidad" name="unidad" class="form-control" type="text" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-offset-1  col-md-4 control-label" for="grupo">Grupo</label> 
          <div class="col-md-7">  
            <input autocomplete="off" required id="grupo" name="grupo" class="form-control" type="text" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="estado">Estado</label> 
          <div class="col-md-7"> 
            <input disabled value="Iniciado" autocomplete="off" required id="estado" name="estado" class="form-control" type="text" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-offset-1 col-md-4 control-label" for="titulo">Titulo</label> 
          <div class="col-md-7"> 
            <input required id="titulo" name="titulo" class="form-control" type="text" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
        </div>

        <div class="form-group col-md-12">
          <div class="col-md-12"> 
            <textarea rows="5" cols="50" required id="titulo" name="titulo" class="form-control" type="text" data-error="*Campo obligatorio"></textarea> 
          </div>
        </div>
        <p class="btn btn-default" style="visibility: hidden;"></p>
        </div>
      <p class="btn btn-default" style="visibility: hidden;"></p>
    </div>
    <div class="col-md-12" style="padding-right:0px">
      <button type="submit" class="pull-right btn btn-primary">Crear</button>
      <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
    </div>
  </form>
</div>
@stop