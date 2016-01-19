@extends('sistema.layouts.default')

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
<div class="tab-content">
  <form method="POST" action="{{ route('edificios.store') }}" data-toggle="validator">
    {!! csrf_field() !!}  
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <h2 class="panel-title">Nuevo Edificio</h1>
      </div>
      <div class="panel-body col-xs-12">
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="razon_social">Razón Social</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" required id="razon_social" name="razon_social" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="cuit">CUIT</label> 
            <div class="col-md-8">  
              <input data-remote="{{ route('validate.edificiocuit') }}" data-remote-error="*CUIT registrado" autocomplete="off" required id="cuit" name="cuit" class="form-control" type="number" max=2147483647 data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="provincia">Provincia</label> 
            <div class="col-md-8"> 
              <input disabled value="Buenos Aires" required id="provincia" name="provincia" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="localidad">Localidad</label> 
            <div class="col-md-8">  
              <input disabled required value="San Justo" id="localidad" name="localidad" class="form-control" type="text" maxlength="10" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="suterh">Clave SUTERH</label> 
            <div class="col-md-8"> 
              <input placeholder="84302/00" data-remote="{{ route('validate.edificiosuterh') }}" data-remote-error="*Clave SUTERH registrada" autocomplete="off" required id="suterh" name="suterh" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="direccion">Dirección</label> 
            <div class="col-md-8">  
              <input autocomplete="off" required id="direccion" name="direccion" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label">Administrador</label>  
            <div class="col-md-8">  
              <select id="admin_id" name="admin_id" class="form-control">
                @foreach ( $admins as $admin )
                <option value="{{ $admin->id }}">{{ $admin->razon_social }}</option>
                @endforeach
              </select>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="pisos">Pisos</label> 
            <div class="col-md-8">  
              <input autocomplete="off" required id="pisos" name="pisos" class="form-control" type="number" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <button type="submit" class="pull-right btn btn-primary">Guardar</button>
        <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
      </div>
    </div>
  </form>
</div>
@stop