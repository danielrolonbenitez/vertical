@extends('administrador.layouts.default')

@section('header')
<link href='css/fullcalendar.min.css' rel='stylesheet' />
<link rel='stylesheet' href='lib/cupertino/jquery-ui.min.css' />
<link rel='stylesheet' href='css/eventosbasic.css' />
<script src='js/jquery.min.js'></script>
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<script src='js/es.js'></script>
@stop

@section('modal')
<!-- Modal para ver info de un evento -->
<div class="modal" id="EventoInfoModal" tabindex="-1" role="dialog" aria-labelledby="UserDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center">
      <div>
        <span><strong> Titulo: </strong> </span>
        <span id="titulo"></span>
      </div>
      <div>
        <span><strong>Descripción: </strong></span>
        <span id="descripcion"></span>
      </div>
      <div class="modal-footer">
        {!! Form::model('1', array('id' => 'EventDeleteForm', 'method' => 'DELETE', 'route' => array('eventos.destroy', ''))) !!}
        {!! csrf_field() !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        {!! Form::submit('Eliminar Evento', array('class' => 'btn btn-danger col-md-offset-1')) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div class="modal" id="UserDeleteModal" tabindex="-1" role="dialog" aria-labelledby="UserDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('users.destroy', ''))) !!}
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
  <div class="panel-primary col-xs-8">
    <div class="panel-heading col-xs-12 form-inline">
      <div class="pull-left">
        <label style="font-size:20px;margin-bottom: 0px">Calendario</label>
      </div>
      <div class="pull-right" style="padding-left:10px;">
        <a class="btn btn-sm btn-success create pull-right"  href="{{ route('eventos.create') }}"  data-placement="bottom" title="Crear Evento"><span class="glyphicon glyphicon-plus"></span></a>
      </div>
    </div>
    <div class="panel-body col-xs-12" style="margin-bottom: 15px;">
      <div id="calendar" style="margin-left:10%;width:80%;"></div>
      <script src='js/calendario.js'></script>
    </div>
  </div>
  <div class="panel panel-primary col-xs-offset-1 col-xs-3 hidden-md" style="padding-right:0px;padding-left:0px;">
    <div class="panel-heading col-xs-12 form-inline">
      <label style="font-size:20px;margin-bottom: 0px">Mis Eventos</label>
    </div>
    <div class="panel-body col-xs-12">
      @if (count($miseventos)!=0)
      @foreach ($miseventos as $evento)
      <ul class="media-list" >
        <li class="media" style="overflow: visible;">
          <div class="media-left" style="padding-left:3px;">
            <div class="panel panel-info text-center date">
              <div class="panel-heading month">
                <span class="panel-title strong">
                  <?php
                  $date = new DateTime( $evento->inicio );
                  $date=$date->format('l');
                  echo strftime("%a", strtotime($date));
                  ?>
                </span>
              </div>
              <div class="panel-body day text-info">
                <?php
                $date = new DateTime( $evento->inicio );
                echo $date->format('d');
                ?>
              </div>
            </div>
          </div>
          <div class="media-body" style="padding-right:3px;">
            <h4 class="media-heading">
              {{$evento->titulo}}
            </h4>
            <p>
              Inicio: {{ date('H:i',strtotime($evento->inicio))}} <br> 
              Duracion: {{ (strtotime($evento->fin) - strtotime($evento->inicio))/3600 }}
            </p>
          </div>
        </li>
      </ul>
      @endforeach
    </div>
    @else
    <div>
      <p align="center">No se encontraron registros.</p>
    </div>
    @endif
    {!! $miseventos->render() !!}
  </div>
  @stop