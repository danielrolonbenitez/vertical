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
  <form method="POST" action="{{ route('admins.store') }}" data-toggle="validator">
    {!! csrf_field() !!}
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <label style="font-size:20px;margin-bottom: 0px">Nuevo Administrador</label>
      </div>
      <div class="panel-body col-xs-12">
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="razon_social">Razón Social</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" required id="razon_social" name="razon_social" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="cuit">CUIT</label> 
            <div class="col-md-8">  
              <input data-remote="{{ route('validate.administradorcuit') }}" data-remote-error="*CUIT registrado" autocomplete="off" required id="cuit" name="cuit" class="form-control input-md" type="number" max=2147483647 data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="provincia">Provincia</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" value="Buenos Aires" disabled required id="provincia" name="provincia" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="localidad">Localidad</label> 
            <div class="col-md-8">  
              <input value="San Justo" disabled required id="localidad" name="localidad" class="form-control" type="text" maxlength="10" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="domicilio">Domicilio</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" required id="domicilio" name="domicilio" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="cp">Código Postal</label> 
            <div class="col-md-8">  
              <input autocomplete="off" required id="cp" name="cp" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="telefono">Teléfono</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" required id="telefono" name="telefono" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="email">Email</label> 
            <div class="col-md-8">  
              <input autocomplete="off" required id="admin_email" name="admin_email" class="form-control" type="email" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="situacion_fiscal">Situación Fiscal</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" disabled value="Responsable Inscripto" required id="situacion_fiscal" name="situacion_fiscal" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="rpa">R.P.A.</label> 
            <div class="col-md-8">  
              <input placeholder="2632" autocomplete="off" required id="rpa" name="rpa" class="form-control" type="number" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>

        <div class="form-group col-md-12">
          <hr style="size:5px;">
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="nombre">Nombre</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" required id="nombre" name="nombre" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="apellido">Apellido</label> 
            <div class="col-md-8">  
              <input autocomplete="off" required id="apellido" name="apellido" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="usuario_mail">Email</label> 
            <div class="col-md-8"> 
              <input data-remote="{{ route('validate.usuarioemail') }}" data-remote-error="*Email registrado" autocomplete="off" required id="email" name="email" class="form-control" type="email" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="password">Contraseña</label> 
            <div class="col-md-8">  
              <input autocomplete="off" required id="password" name="password" class="form-control" type="password" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12" style="padding-right:0px">
      <button type="submit" class="pull-right btn btn-primary">Guardar</button>
      <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
    </div>
  </form>
</div>
@stop