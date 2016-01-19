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
  {!! Form::model($edificio, array('route' => array('edificios.update', $edificio->id), 'method' => 'PATCH', 'data-toggle' => 'validator')) !!}
  {{ csrf_field() }}
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Editar Edificio</h2>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6 has-feedback">
          <label class="col-md-4 control-label" for="razon_social">Razón Social</label> 
          <div class="col-md-8"> 
            <input autocomplete="off" value="{{ $edificio->razon_social }}" required id="razon_social" name="razon_social" class="form-control input-md" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6 has-feedback">
          <label class="col-md-4 control-label" for="cuit">CUIT</label> 
          <div class="col-md-8">  
            <input data-remote="{{ route('validate.edificiocuit') }}" data-remote-error="*CUIT registrado" value="{{ $edificio->cuit }}" required id="cuit" name="cuit" class="form-control" type="text" maxlength="10" data-error="*Campo obligatorio">
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
            <input data-remote="{{ route('validate.edificiosuterh') }}" data-remote-error="*Clave SUTERH registrada" autocomplete="off" value="{{ $edificio->suterh }}" required id="suterh" name="suterh" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6 has-feedback">
          <label class="col-md-4 control-label" for="direccion">Dirección</label> 
          <div class="col-md-8">  
            <input autocomplete="off" value="{{ $edificio->direccion }}" required id="direccion" name="direccion" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6 has-feedback">
          <label class="col-md-4 control-label">Administrador</label> 
          <div class="col-md-8"> 
            <select id="admin_id" name="admin_id" class="form-control input-md">
              <option value="{{ $admin->id }}">{{ $admin->razon_social }}</option>

            </select>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6 has-feedback">
          <label class="col-md-4 control-label" for="pisos">Pisos</label> 
          <div class="col-md-8">  
            <input disabled value="{{ count($piso) }}" required id="pisos" name="pisos" class="form-control input-md" type="number" data-error="*Campo obligatorio">
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
  {!! Form::close() !!}
</div>
@stop
