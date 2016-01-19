@extends('inquilino.layouts.default')

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
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <label style="font-size:20px;margin-bottom: 0px">Nuevo Reclamo</label>
      </div>
      <div class="panel-body col-xs-12">
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="edificio_id">Edificio</label> 
            <div class="col-md-8"> 
              <select class="form-control" id="edificio_id" name="edificio_id" onChange="getState(this.value);">
              @foreach ($edificios as $edificio)
                <option value="{{ $edificio->id }}">{{ $edificio->razon_social }}</option>
              @endforeach
              </select>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="unidad_id">Unidad</label> 
            <div class="col-md-8"> 
              <select class="form-control" id="unidad_id" name="unidad_id">
              @foreach ($unidades as $unidad)
                <option value="{{ $unidad->id }}">{{ $unidad->numero }} {{ $unidad->letra }}</option>
              @endforeach
              </select>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="grupo_id">Grupo</label> 
            <div class="col-md-8">  
              <select class="form-control" id="grupo_id" name="grupo_id">
              @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
              @endforeach
              </select>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="estado">Estado</label> 
            <div class="col-md-8"> 
              <input disabled value="INICIADO" autocomplete="off" required id="estado" name="estado" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="titulo">Titulo</label> 
            <div class="col-md-8"> 
              <input required id="titulo" name="titulo" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12 has-feedback">
            <div class="col-md-12"> 
              <textarea rows="5" cols="50" required id="descripcion" name="descripcion" class="form-control" data-error="*Campo obligatorio"></textarea> 
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
    </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <button type="submit" class="pull-right btn btn-primary">Crear</button>
        <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
      </div>
    </div>
  </form>
</div>
@stop

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
<script type="text/javascript">
  function getState(val) {
    $.ajax({
    type: "POST",
    url: "http://clusterix.com.ar/vertical/public/validate/unidad",
    data:'edificio_id='+val,
    success: function(data){
      $("#unidad_id").html(data);
    }
    });
  }
</script>
@stop