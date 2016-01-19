@extends('inquilino.layouts.default')

@section('modal')
<!-- Modal para solicitar confirmacion antes de eliminar un Usuario -->
<div class="modal" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('eventos.destroy', $evento->id ))) !!}
      {!! csrf_field() !!}
      <div class="modal-header text-center">
        ¿Esta seguro que desea realizar esta operación?
      </div>
      <div class="modal-body text-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        {!! Form::submit('Aceptar', array('class' => 'btn btn-primary col-md-offset-1')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop

@section('content')
<?php setlocale(LC_ALL,"es_ES"); ?>
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
        <h2 class="panel-title">Evento</h2>
      </div>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Creador</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{$user->nombre}} {{$user->apellido}}</p>
          </div>
        </div>

        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Inicio</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $evento->inicio }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Fin</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $evento->fin }}</p>
          </div>
        </div>

        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Duracion (hh)</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ (strtotime($evento->fin) - strtotime($evento->inicio))/3600 }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Título</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $evento->titulo }}</p>
          </div>
        </div>

        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Amenitie</label> 
          <div class="col-md-8"> 
            <p class="form-control">@if($amenitie) {{ $amenitie->descripcion }} @else Ninguno @endif</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label class="col-md-4 control-label">Descripcion</label> 
          <textarea readonly rows="5" cols="50" id="descripcion" name="descripcion" class="form-control">{{ $evento->descripcion }}</textarea> 
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="row">
    @if ( $user->id == Auth::user()->id)
      <a href="{{ route('eventos.edit', $evento->id ) }}" class="pull-right btn btn-primary">Editar</a>
      <button class="pull-right btn btn-danger delete" data-toggle="modal" data-target="#DeleteModal" title="Eliminar" style="margin-right:15px">Eliminar</button>
    @endif
      <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
    </div>
  </div>
</div>
@stop