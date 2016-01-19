@extends('propietario.layouts.default')

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
  @if ( isset($_GET["order"]) && str_is($_GET["order"],'asc'))
  <?php $order="desc" ?>
  @else
  <?php $order="asc" ?>
  @endif
  <div class="tab-pane active">
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <form method="GET" id="search-form" action="{{ route('expensas.index') }}">
          <div class="pull-left">
            <label style="font-size:20px;margin-bottom: 0px">Expensas</label>
          </div>
          <button class="pull-right btn btn-sm btn-default" type="submit" ><span class="glyphicon glyphicon-search"></span></button>
          <div class="form-group form-group-xm pull-right">
            <input type="hidden" name="id" id="id" value="{{ $edificio_id }}">
            <input style="height:30px;" name="search" id="search" type="text" class="form-control" placeholder="Buscar">
          </div>
        </form>
      </div>
      <div class="panel-body col-xs-12">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="col-md-1">
                <a href="{{ route('expensas.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=id&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">ID</a>
              </th>
              <th>
                <a href="{{ route('expensas.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=created_at&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Periodo</a>
              </th>
              <th>
                <a href="{{ route('expensas.index') }}?id=<?php echo $_GET["id"]?>&amp;sortby=vencimiento&amp;order=<?php echo $order ?><?php if (isset($_GET["search"])) { echo "&amp;search=".$_GET["search"]; } ?>">Vencimiento</a>                
              </th>
              <th>
                <a>Operaciones</a>                    
              </th>
            </tr>
          </thead>       
          <tbody>
            @if (count($expensas)!=0)
            @foreach ($expensas as $expensa)
            <tr>
              <td>{{ $expensa->id }}</td>
              <td>{{ date("Y-m-d",strtotime($expensa->created_at)) }}</td>
              <td>{{ $expensa->vencimiento }}</td>
              <td><a class="btn btn-xs btn-danger" href="{{ route('expensas.show', $expensa->id ) }}?id={{ $edificio_id }}"><span class="glyphicon glyphicon-file" title="Descargar"></span> Descargar</a></td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4" align="center">No se encontraron registros.</td>
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
{!! $expensas->appends(['sortby' => $sortby, 'order' => $order, 'search' => $search, 'id' => $edificio_id])->render() !!}
@stop