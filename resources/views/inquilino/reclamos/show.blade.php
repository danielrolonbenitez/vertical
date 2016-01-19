@extends('inquilino.layouts.default')

@section('modal')
<!-- Modal para solicitar confirmacion antes de eliminar un Usuario -->
<div class="modal" id="CloseModal" tabindex="-1" role="dialog" aria-labelledby="CloseModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('reclamos.destroy', $reclamo->id))) !!}
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
    <div class="alert alert-danger alert-dimdissable">
      <button type="button" class="close" data-dimdiss="alert" aria-hidden="true">×</button>
      @foreach ($errors->all() as $error)
      {{ $error }}</br>
      @endforeach
    </div>
  </div>
  @endif
  {!! Form::model($usuario, array('route' => array('reclamos.update', $reclamo->id), 'method' => 'PATCH', 'data-toggle' => 'validator')) !!}
    {{ csrf_field() }}
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
          <label style="font-size:20px;margin-bottom: 0px">Reclamo Numero {{ $reclamo->id }}</label>
          @if ( !$reclamo->deleted_at )
          @if ( $usuario->id == Auth::user()->id )
          <div class="pull-right" style="padding-left:10px;">
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#CloseModal" title="Cerrar"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
          </div>
          @endif
          <div class="pull-right" style="padding-left:10px;">
            <button type="submit" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Actualizar"><span class="glyphicon glyphicon-plus"></span> Actualizar</button>
          </div>
          @endif
      </div>
      <div class="panel-body col-xs-12">
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Solicitante</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{$usuario->nombre}} {{$usuario->apellido}}</p>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Fecha Creacion</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{$reclamo->created_at}}</p>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Actualizacion</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{$reclamo->updated_at}}</p>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Fecha Cierre</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{$reclamo->deleted_at}}</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Edificio</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{$edificio->razon_social}}</p>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Unidad</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{$unidad->numero}}{{$unidad->letra}}</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class=" col-md-4 control-label" for="grupo_id">Grupo</label> 
            <div class="col-md-8">  
              <select class="form-control" id="grupo_id" name="grupo_id">
                @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}" @if ( $grupo->id == $reclamo->grupo_id) selected @endif>{{ $grupo->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Estado</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{$reclamo->estado}}</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label class="col-md-4 control-label">Titulo</label> 
            <div class="col-md-8"> 
              <p class="form-control" readonly>{{ $reclamo->titulo }}</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <div class="col-md-12"> 
              <textarea class="form-control" rows="5" cols="50" readonly id="descripcion" name="descripcion" data-error="*Campo obligatorio">{{ $reclamo->descripcion }}</textarea> 
            </div>
          </div>
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Notas</h2>
    </div>
    @if ( !$reclamo->deleted_at )
    <div class="panel-body col-xs-12">
      <form method="POST" action="{{ route('notas.store') }}" data-toggle="validator">
        {{ csrf_field() }}  
        <div class="form-group col-xs-12">
          <div class="row">
            <div class="col-md-12"> 
              <textarea rows="5" cols="50" required id="nota" name="nota" class="form-control" data-error="*Campo obligatorio"></textarea> 
              <input type="hidden" name="reclamo_id" value="{{ $reclamo->id }}">
            </div>
          </div>
        </div>
        <div class="form-group col-xs-12">
          <div class="row" >
            <button style="margin-right:15px;" type="submit" class="pull-right btn btn-primary">Guardar</button>
            <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
          </div>
        </div>
      </form>
    </div>
    @endif
    @foreach ($notas as $nota)
    <div class="form-group col-md-12">
      <div class="col-md-12" style="border-top-style: solid;border-color: #08065f;"> 
        <div class="row" >
        <p style="margin-top: 10px;"><strong>{{ $nota->created_at }}</strong> | {{ $nota->nombre }} {{ $nota->apellido }} ({{ $nota->email }})</p>
        </div>
        <div class="row" >
        <textarea rows="5" cols="50" readonly class="form-control" data-error="*Campo obligatorio">
        {{ $nota->texto }}
        </textarea> 
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@stop