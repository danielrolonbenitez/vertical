@extends('inquilino.layouts.default')

@section('header')
<!--<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}" />-->
@stop

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/jquery.datetimepicker.css') }}" />
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
  {!! Form::model($evento, array('route' => array('eventos.update', $evento->id), 'method' => 'PATCH', 'data-toggle' => 'validator')) !!}
  {{ csrf_field() }}
    {!! csrf_field() !!}
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <div class="pull-left">
          <h2 class="panel-title">Editar Evento</h2>
        </div>
      </div>
      <div class="panel-body col-xs-12">
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="inicio">Inicio</label> 
            <div class="col-md-8"> 
              <input value="{{ $evento->inicio }}" id="inicio" autocomplete="off" required name="inicio" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="fin">Fin</label> 
            <div class="col-md-8">  
              <input value="{{ $evento->fin }}" id="fin" autocomplete="off" required name="fin" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback"> 
            <label class="col-md-4 control-label" for="amenitie_id">Amenitie</label> 
            <div class="col-md-8">
              <select id="amenitie_id" name="amenitie_id" class="form-control">
                <option value="999">Ninguno</option>
                @foreach ($amenities as $amenitie)
                <option value="{{ $amenitie->id }}" @if ( $evento->amenitie_id == $amenitie->id ) selected @endif>{{ $amenitie->descripcion }}</option>
                @endforeach
              </select>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="titulo">Titulo</label> 
            <div class="col-md-8">  
              <input value="{{ $evento->titulo }}" autocomplete="off" required id="titulo" name="titulo" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12 has-feedback">
            <label class="col-md-4 control-label" for="descripcion">Descripcion (Opcional)</label> 
              <textarea rows="5" cols="50" id="descripcion" name="descripcion" class="form-control">{{ $evento->descripcion }}</textarea> 
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

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.datetimepicker.js') }}"></script>
          <script type="text/javascript">
  jQuery('#inicio').datetimepicker();
  jQuery('#fin').datetimepicker();
</script>
<!--<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>
<script>
  $(function() {
    $( "#dia" ).datepicker({ dateFormat: "yy-mm-dd" }).val()
  });
</script>-->

@stop