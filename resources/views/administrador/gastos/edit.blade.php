@extends('administrador.layouts.default')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/jquery.datetimepicker.css') }}" />
@stop

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
  {!! Form::model($gasto, array('route' => array('gastos.update', $gasto->id), 'method' => 'PATCH', 'data-toggle' => 'validator')) !!}
  {{ csrf_field() }}
    <input type="hidden" name="edificio_id" value="{{ $edificio_id }}}">
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <div class="pull-left">
          <h2 class="panel-title">Editar Gasto</h2>
        </div>
      </div>
      <div class="panel-body col-xs-12">
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="fecha">Fecha</label> 
            <div class="col-md-8"> 
              <input value="{{ $gasto->fecha }}" required id="fecha" name="fecha" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="descripcion">Descripcion</label> 
            <div class="col-md-8">  
              <input value="{{ $gasto->descripcion }}" autocomplete="off" required id="q" name="descripcion" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="comprobante">Comprobante</label> 
            <div class="col-md-8"> 
              <input value="{{ $gasto->comprobante }}" required id="comprobante" name="comprobante" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label" for="importe">Importe</label> 
            <div class="col-md-8"> 
              <input value="{{ $gasto->importe }}" required id="importe" name="importe" class="form-control" type="number" step="0.01" data-error="*Campo obligatorio">
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

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.js') }}"></script>
 <script>
    function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
    }
    $.datetimepicker.setLocale('es');
    var d = new Date();
    var min = d.getDate();
    var m = d.getMonth()+1;
    var y = d.getFullYear();
    var max=daysInMonth(m,y);
    var a = 7;
    jQuery('#fecha').datetimepicker({ 
     timepicker:false,
     format:'Y-m-d',
     minDate:'-1970/01/'+min,
     maxDate:'+1970/01/'+(max-min+1)
    });
  </script>
  <script>
  $(function()
  {
     $( "#q" ).autocomplete({
      source: "http://www.clusterix.com.ar/vertical/public/test",
      minLength: 1,
      select: function(event, ui) {
        $('#q').val(ui.item.value);
      }
    });
  });
  </script>
@stop