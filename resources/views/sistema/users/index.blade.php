@extends('sistema.layouts.default')

@section('modal')
<!-- Modal para solicitar confirmacion antes de eliminar un Usuario -->
<div class="modal" id="UserDeleteModal" tabindex="-1" role="dialog" aria-labelledby="UserDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form id="DeleteForm" method="POST" action="{{ route('users.destroy') }}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-header text-center">
          ¿Esta seguro que desea realizar esta operación?
        </div>
        <div class="modal-body text-center">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          {!! Form::submit('Aceptar', array('class' => 'btn btn-primary col-md-offset-1')) !!}
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('content')
<div class="tab-content">
  @if (Session::get('alert') == 1)
  <div class="alert-group">
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Información</strong> La operación se ha realizado con éxito.
    </div>
  </div>
  @endif
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
  @if ( isset($_GET["order"]) && str_is($_GET["order"],'asc'))
  <?php $order="desc" ?>
  @else
  <?php $order="asc" ?>
  @endif
  <div class="tab-pane active">
    <div class="panel-primary col-xs-12">   
      <div class="panel-heading col-xs-12 form-inline">
        <form method="GET" id="search-form" action="{{ route('users.index') }}">
          <div class="pull-left">
            <label style="font-size:20px;margin-bottom: 0px">Usuarios</label>
          </div>
          <div class="pull-right" style="padding-left:10px;">
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-success create" data-toggle="tooltip" data-placement="bottom" title="Agregar"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
          <button class="pull-right btn btn-sm btn-default" type="submit" ><span class="glyphicon glyphicon-search"></span></button>
          <div class="form-group form-group-xm pull-right">
            <input style="height:30px;" name="search" id="search" type="text" class="form-control" placeholder="Buscar">
          </div>
        </form>
      </div>
      <div class="panel-body col-xs-12">
        <table class="table table-hover" id="usuarios">
          <thead>
            <tr class="filters">
              <th class="col-md-1">
                <a href="{{ route('users.index') }}?sortby=id&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">ID</a>
              </th>
              <th class="hidden-xs">
                <a href="{{ route('users.index') }}?sortby=nombre&amp;order=<?php echo $order;if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Nombre</a>
              </th>
              <th class="hidden-xs">
                <a href="{{ route('users.index') }}?sortby=apellido&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Apellido</a>                 
              </th>
              <th>
                <a href="{{ route('users.index') }}?sortby=email&amp;order=<?php echo $order; if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Email</a>                 
              </th>
              <th class="hidden-xs hidden-sm">
                <a href="{{ route('users.index') }}?sortby=rol&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&search=".$_GET["search"]; } ?>">Rol</a>                    
              </th>
              <th>
                <a>Operaciones</a>
              </th>
            </tr>
          </thead>       
          <tbody>
            @if (count($users)!=0)
            @foreach ($users as $user)
            <tr>
              <td class="user_i col-md-1">{{ $user->id }}</td>
              <td class="hidden-xs">{{ $user->nombre }}</td>
              <td class="hidden-xs">{{ $user->apellido }}</td>
              <td >{{ $user->email }}</td>
              <td class="hidden-xs hidden-sm">{{ $user->rol }}</td>
              <td>
                <a href="{{ route('users.index') }}/{{ $user->id }}" class="btn btn-xs btn-info" title="Detalle"><span class="glyphicon glyphicon-info-sign"></span></a>
                @if ( $user->id != Auth::user()->id )
                <button class="btn btn-xs btn-danger delete" data-toggle="modal" data-target="#UserDeleteModal" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
                @endif
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="6" align="center">No se encontraron registros.</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@if ( isset($_GET["sortby"]) )
<?php $sortby=$_GET["sortby"] ?>
@else
<?php $sortby="id" ?>
@endif
@if ( isset($_GET["order"]) )
<?php $order=$_GET["order"] ?>
@else
<?php $order="asc" ?>
@endif
@if ( isset($_GET["search"]) )
<?php $search=$_GET["search"] ?>
@else
<?php $search="" ?>
@endif
{!! $users->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search])->render() !!}
@stop

@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/UsersOperations.js') }}"></script>
@stop