@extends('sistema.layouts.default')

@section('modal')

<!-- Modal para crear una nueva Unidad Funcional -->
<div class="modal" id="UnidadCreateModal" tabindex="-1" role="dialog" aria-labelledby="UnidadCreateModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        {!! Form::model('1', array('id'=>'CreateFormUnidad', 'method'=>'POST', 'route' => array('unidades.store', ''), 'data-toggle'=>'validator')) !!}
        {!! csrf_field() !!}
        <div class="panel-primary">
          <div class="panel-heading">
            <h2 class="panel-title">Nueva Unidad Funcional</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="piso_id">Piso</label> 
                <div class="col-sm-8"> 
                  <select class="form-control" id="piso_id" name="piso_id">
                    @foreach ($piso as $pi)
                    <option value="{{ $pi->id }}">{{ $pi->numero }}</option>
                    @endforeach
                  </select>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="letra">Letra</label> 
                <div class="col-sm-8">  
                  <input autocomplete="off" required id="letra" name="letra" class="form-control" type="text" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="porcentaje">%</label> 
                <div class="col-sm-8"> 
                  <input required id="porcentaje" name="porcentaje" class="form-control" type="number" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="metros">Mts²</label> 
                <div class="col-sm-8">  
                  <input required id="metros" name="metros" class="form-control" type="number" step="0.01" min="0" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div> 
            </div>
          </div>
        </div>
        <div class="row">
          <button type="submit" class="pull-right btn btn-primary" style="margin-right:15px">Guardar</button>
          <button type="button" class="pull-right btn btn-default" style="margin-right:15px" data-dismiss="modal">Cancelar</button>
        </div>
        {!! Form::close() !!}
      </div>  
    </div>
  </div>
</div>

<!-- Modal para solicitar confirmacion antes de eliminar una Unidad Funcional -->
<div class="modal" id="UnidadDeleteModal" tabindex="-1" role="dialog" aria-labelledby="UnidadDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('unidades.destroy', ''))) !!}
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

<!-- Modal para editar los datos de una Unidad Funcional -->
<div class="modal" id="UnidadEditModal" tabindex="-1" role="dialog" aria-labelledby="UnidadEditModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      {!! Form::model('1', array('id' => 'EditForm', 'method' => 'PATCH', 'route' => array('unidades.update', ''), 'data-toggle'=>'validator')) !!}
      {!! csrf_field() !!}
        <input hidden id="unidad_id_e" name="unidad_id" type="text" style="border:0px;" >
        <div class="panel-primary">
          <div class="panel-heading">
              <h2 class="panel-title">Editar Unidad Funcional</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="piso_id_e">Piso</label> 
                <div class="col-sm-8"> 
                  <select class="form-control" id="piso_id_e" name="piso_id_e">
                    @foreach ($piso as $pi)
                    <option value="{{ $pi->id }}">{{ $pi->numero }}</option>
                    @endforeach
                  </select>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="letra_e">Letra</label> 
                <div class="col-sm-8">  
                  <input autocomplete="off" required id="letra_e" name="letra_e" class="form-control" type="text" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="porcentaje_e">%</label> 
                <div class="col-sm-8"> 
                  <input required id="porcentaje_e" name="porcentaje_e" class="form-control" type="number" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group col-sm-6 has-feedback">
                <label class="col-sm-4 control-label" for="metros_e">Mts²</label> 
                <div class="col-sm-8">  
                  <input required id="metros_e" name="metros_e" class="form-control" type="number" step="0.01" min="0" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div> 
            </div>
          </div>
        </div>
        <div class="row">
          <button type="submit" class="pull-right btn btn-primary" style="margin-right:15px">Guardar</button>
          <button type="button" class="pull-right btn btn-default" style="margin-right:15px" data-dismiss="modal">Cancelar</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<!-- Modal para crear un nuevo Amenitie -->
<div class="modal" id="AmenitieCreateModal" tabindex="-1" role="dialog" aria-labelledby="AmenitieCreateModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::model('1', array('id'=>'CreateFormAmenitie', 'method'=>'POST', 'route' => array('amenities.store', ''), 'data-toggle'=>'validator')) !!}
      {!! csrf_field() !!}
      <div class="modal-body"> 
        <div class="panel-primary">
          <div class="panel-heading">
            <h2 class="panel-title">Nuevo Amenitie</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-sm-12 has-feedback">
                <label class="col-sm-4 control-label" for="descripcion">Descripcion</label> 
                <div class="col-sm-8">  
                  <input autocomplete="off" required id="descripcion" name="descripcion" class="form-control" type="text" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <button type="submit" class="pull-right btn btn-primary" style="margin-right:15px">Guardar</button>
          <button type="button" class="pull-right btn btn-default" style="margin-right:15px" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Modal para editar los datos de un Amenitie -->
<div class="modal" id="AmenitieEditModal" tabindex="-1" role="dialog" aria-labelledby="AmenitieEditModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        {!! Form::model('1', array('id' => 'AmenitieEditForm', 'method' => 'PATCH', 'route' => array('amenities.update', ''), 'data-toggle'=>'validator')) !!}
        {!! csrf_field() !!}
        <div class="panel-primary">
          <div class="panel-heading">
            <h2 class="panel-title">Editar Amenitie</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-sm-12 has-feedback">
                <label class="col-sm-4 control-label" for="descripcion_e">Descripcion</label> 
                <div class="col-sm-8">  
                  <input autocomplete="off" required id="descripcion_e" name="descripcion_e" class="form-control" type="text" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <button type="submit" class="pull-right btn btn-primary" style="margin-right:15px">Guardar</button>
          <button type="button" class="pull-right btn btn-default" style="margin-right:15px" data-dismiss="modal">Cancelar</button>
        </div>
        {!! Form::close() !!}
      </div>     
    </div>
  </div>
</div>

<!-- Modal para solicitar confirmacion antes de eliminar un Amenitie -->
<div class="modal" id="AmenitieDeleteModal" tabindex="-1" role="dialog" aria-labelledby="AmenitieDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'AmenitieDeleteForm', 'method' => 'DELETE', 'route' => array('amenities.destroy', ''))) !!}
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
@if (Session::get('alert') == 1)
<div class="alert-group">
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Información</strong> La operación se ha realizado con éxito.
  </div>
</div>
@endif
@if (Session::get('alert') == 0)
<div class="alert-group">
  <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Atención</strong> Revise los porcentajes de las unidades funcionales.
  </div>
</div>
@endif
<div class="tab-content">
  <!-- Detalle Edificio -->
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <form method="GET" id="search-form" action="{{ route('edificios.index') }}">
        <div class="pull-left">
          <h2 class="panel-title">Edificio</h2>
        </div>
        <div class="pull-right">
          <a href="{{ route('edificios.edit', $edificio->id) }}" class="btn btn-xs btn-warning" title="Agregar"><span class="glyphicon glyphicon-pencil"></span></a>
        </div>
      </form>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Razón Social</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $edificio->razon_social }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">CUIT</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $edificio->cuit }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Provincia</label> 
          <div class="col-md-8"> 
            <p class="form-control">Buenos Aires</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Localidad</label> 
          <div class="col-md-8">  
            <p class="form-control">San Justo</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Clave SUTERH</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $edificio->suterh }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Dirección</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $edificio->direccion }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Administrador</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->razon_social }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Pisos</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ count($piso) }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Detalle Pisos -->
  <div class="panel-primary col-xs-12" id="unidades">
    <div class="panel-heading col-xs-12 form-inline">
      <div class="pull-left">
        <h2 class="panel-title">Unidades Funcionales</h2>
      </div>
      <div class="pull-right">
        <button data-toggle="modal" data-target="#UnidadCreateModal" class="btn btn-xs btn-success create" title="Agregar"><span class="glyphicon glyphicon-plus"></span></button>
      </div>
    </div>
    <div class="panel-body col-xs-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="col-md-1">Unidad</th>
            <th>Propietario</th>
            <th>Inquilino</th>
            <th class="col-md-1 hidden-sm">%</th>
            <th class="col-md-1 hidden-sm">Mts²</th>
            <th class="col-md-2">Operaciones</th>
          </tr>
        </thead>       
        <tbody>   
          @if (count($pisos)!=0)  
          @foreach ( $pisos as $p )
          <tr>
            <td class="col-md-1">{{ $p->numero }}{{ $p->letra }}</td>
            <td class="unidad_n" hidden="hidden">{{ $p->numero }}</td>
            <td class="unidad_i" hidden="hidden">{{ $p->id }}</td>
            <td class="unidad_l" hidden="hidden">{{ $p->letra }}</td>
            <td>{{ $p->propietario }}</td>
            <td>{{ $p->nombre }} {{ $p->apellido }}</td>
            <td class="unidad_p col-md-1 hidden-sm">{{ $p->porcentaje }}</td>
            <td class="unidad_m col-md-1 hidden-sm">{{ $p->metros }}</td>
            <td class="col-md-2">
              <button class="btn btn-xs btn-warning edit" data-toggle="modal" data-target="#UnidadEditModal" title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button>
              <button class="btn btn-xs btn-danger delete" data-toggle="modal" data-target="#UnidadDeleteModal" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
              <a href="{{ route('unidad.propietarios.show', $p->id ) }}" class="btn btn-xs btn-info" title="Propietarios"><span class="glyphicon glyphicon-user"></span></a>
              <a href="{{ route('unidad.inquilinos.show', $p->id ) }}" class="btn btn-xs btn-success" title="Inquilinos"><span class="glyphicon glyphicon-user"></span></a>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="8" align="center">No se encontraron registros.</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <!-- Detalle Amenities -->
  <div class="panel-primary col-xs-12" id="amenities">
    <div class="panel-heading col-xs-12 form-inline">
      <div class="pull-left">
        <h2 class="panel-title">Amenities</h2>
      </div>
      <div class="pull-right">
        <button data-toggle="modal" data-target="#AmenitieCreateModal" class="btn btn-xs btn-success add" title="Agregar"><span class="glyphicon glyphicon-plus"></span></button>
      </div>
    </div>
    <div class="panel-body col-xs-12">
      <table class="table table-hover">
        <thead>
          <tr class="filters">
            <th class="col-md-1">ID</th>
            <th class="col-md-9">Descripción</th>
            <th class="col-md-2">Operaciones</th>
          </tr>
        </thead>       
        <tbody>
          @if (count($amenities)!=0)     
          @foreach ( $amenities as $amenitie )
          <tr>
            <td class="amenitie_i col-md-1">{{ $amenitie->id }}</td>
            <td class="amenitie_d col-md-9">{{ $amenitie->descripcion }}</td>
            <td class="col-md-2">
              <button class="btn btn-xs btn-warning edit_amenitie" data-toggle="modal" data-target="#AmenitieEditModal" title="Editar"><span class="glyphicon glyphicon-pencil"></span></button>
              <button class="btn btn-xs btn-danger delete_amenitie" data-toggle="modal" data-target="#AmenitieDeleteModal" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="3" align="center">No se encontraron registros.</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <!-- Ubicacion -->
  <div class="panel-primary col-xs-12" id="ubicacion">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Ubicación</h2>
    </div>
    <div style="background-color: white;">
      <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q={{$edificio->direccion}}%20San%20Justo%20Buenos%20Aires%20Argentina&amp;key=AIzaSyCPpkhmh7Ztzg6bmrBNYM18aurw9ktWFQE" allowfullscreen></iframe> 
    </div>
  </div>
</div>

<div class="form-group col-sm-14">
  <a href="javascript:history.back()" class="pull-right btn btn-primary">Volver</a>
</div>
@stop

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/UnidadesOperations.js') }}"></script>
@stop