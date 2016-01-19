@extends('propietario.layouts.default')

@section('content')
@if (Session::get('alert') == 1)
<div class="alert-group">
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Información</strong> La operación se ha realizado con éxito.
  </div>
</div>
@endif
<div class="tab-content">
  <!-- Detalle Edificio -->
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Edificio</h2>
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

<div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12">
      <h2 class="panel-title">Administración</h2>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Razón Social</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $admin->razon_social }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">CUIT</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->cuit }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Provincia</label> 
          <div class="col-md-8"> 
            <p class="form-control input-md">Buenos Aires</p>
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
          <label class="col-md-4 control-label">Domicilio</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $admin->domicilio }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Código Postal</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->cp }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Teléfono</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ $admin->telefono }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Email</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->email }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Situación Fiscal</label> 
          <div class="col-md-8"> 
            <p class="form-control">Responsable Inscripto</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">R.P.A.</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $admin->rpa }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Estado</label> 
          <div class="col-md-8">  
            <p class="form-control">
              @if ( $admin->estado == 1 ) Activo @endif
              @if ( $admin->estado == 0 ) Inactivo @endif
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Detalle Pisos -->
  <div class="panel-primary col-xs-12" id="unidades">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Unidades Funcionales</h2>
    </div>
    <div class="panel-body col-xs-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="col-md-1">Unidad</th>
            <th>Propietario</th>
            <th>Inquilino</th>
            <th class="col-md-2 hidden-xs">Porcentaje (%)</th>
            <th class="col-md-2 hidden-xs">Metros (mts²)</th>
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
            <td class="unidad_p col-md-2 hidden-xs">{{ $p->porcentaje }}</td>
            <td class="unidad_m col-md-2 hidden-xs">{{ $p->metros }}</td>
            <td class="col-md-2">
            @if( $p->propietario_id==Auth::user()->id)
              <a href="{{ route('unidad.inquilinos.show', $p->id ) }}" class="btn btn-xs btn-success" title="Inquilinos"><span class="glyphicon glyphicon-user"></span> Inquilino</a>
            @endif
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
      <h2 class="panel-title">Amenities</h2>
    </div>
    <div class="panel-body col-xs-12">
      <table class="table table-hover">
        <thead>
          <tr class="filters">
            <th class="col-md-1">ID</th>
            <th class="col-md-11">Descripción</th>
          </tr>
        </thead>       
        <tbody>
          @if (count($amenities)!=0)     
          @foreach ( $amenities as $amenitie )
          <tr>
            <td class="amenitie_i col-md-1">{{ $amenitie->id }}</td>
            <td class="amenitie_d col-md-11">{{ $amenitie->descripcion }}</td>
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="2" align="center">No se encontraron registros.</td>
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
