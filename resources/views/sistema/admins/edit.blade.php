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
  {!! Form::model($admin, array('route' => array('admins.update', $admin->id), 'method' => 'PATCH', 'data-toggle' => 'validator')) !!}
  {{ csrf_field() }}
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <label style="font-size:20px;margin-bottom: 0px">Editar Administrador</label>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="razon_social">Razón Social</label> 
          <div class="col-md-8"> 
            <input autocomplete="off" value="{{ $admin->razon_social }}" required id="razon_social" name="razon_social" class="form-control input-md" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="cuit">CUIT</label> 
          <div class="col-md-8">  
            <input autocomplete="off" value="{{ $admin->cuit }}" required id="cuit" name="cuit" class="form-control" type="number" max=2147483647 data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="provincia">Provincia</label> 
          <div class="col-md-8"> 
            <input disabled value="{{ $admin->provincia }}" required id="provincia" name="provincia" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="localidad">Localidad</label> 
          <div class="col-md-8">  
            <input disabled required value="{{ $admin->localidad }}" id="localidad" name="localidad" class="form-control" type="text" maxlength="10" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="domicilio">Domicilio</label> 
          <div class="col-md-8"> 
            <input autocomplete="off" value="{{ $admin->domicilio }}" required id="domicilio" name="domicilio" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="cp">Código Postal</label> 
          <div class="col-md-8">  
            <input autocomplete="off" value="{{ $admin->cp }}" required id="cp" name="cp" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="telefono">Teléfono</label> 
          <div class="col-md-8"> 
            <input autocomplete="off" value="{{ $admin->telefono }}" required id="telefono" name="telefono" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="email">Email</label> 
          <div class="col-md-8">  
            <input autocomplete="off" value="{{ $admin->email }}" required id="email" name="email" class="form-control" type="email" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="situacion_fiscal">Situación Fiscal</label> 
          <div class="col-md-8"> 
            <input disabled value="Responsable Inscripto" id="situacion_fiscal" name="situacion_fiscal" class="form-control" type="text" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="rpa">R.P.A.</label> 
          <div class="col-md-8">  
            <input autocomplete="off" value="{{ $admin->rpa }}" required id="rpa" name="rpa" class="form-control" type="number" data-error="*Campo obligatorio">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="estado">Estado</label> 
          <div class="col-md-8">  
            <select class="form-control" id="estado" name="estado">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12" style="padding-right:0px">
    <button type="submit" class="pull-right btn btn-primary">Guardar</button>
    <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
  </div>
  {!! Form::close() !!}
</div>
@stop