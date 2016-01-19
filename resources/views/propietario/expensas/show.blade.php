<style>
.fondo-green{background: #08065F;}

#encabezado{color: white;text-align: center;padding-top: 5px;padding-bottom: 5px;font-size: 20px;}
.title-green{color:#08065F;font-size: 20px;}
#administracion{float: left;margin-top: 20px}
.centrar{margin-left: 20px}
#consorcio{float:left;margin-left: 470px;}
/*begin stile table*/
#cuenta-title{margin-top: 250px;color: white;text-align:center;padding-bottom: 5px;padding-top: 5px;font-size:20px; }

.boldtable{}
td{border: 1px solid black;padding: 5px;}
.head-table{width: 95px}
.pro{}
.table-footer{background: #08065F;color: white;}

</style>


<div id="container">
  <div id="cabezera">

        <div id="encabezado" class="fondo-green">
                  <span>MIS EXPENSAS</span><br></br>
                  <span>Liquidación de mes: {{ $expensa->vencimiento }}</span><br></br>
                 </div>

             <div id="administracion">
              <span class="title-green">ADMINISTRACIÓN</span><br></br>
              <span>Razon Social:</span><span>{{ $admin->razon_social }}</span><br></br>
              <span>Domicilio:</span><span>{{ $admin->domicilio }}</span><br></br>
              <span>Localidad:</span><span>San Justo</span><br></br>
              <span>Provincia:</span><span>Buenos Aires</span><br></br>
              <span>Codigo Postal:</span><span>{{ $admin->cp }}</span><br></br>
              <span>Mail:</span><span>{{ $admin->email}}</span><span class="centrar">Te:</span><span>{{ $admin->telefono }}</span><br></br>
              <span>Cuit:</span><span>{{ $admin->cuit }}</span><span class="centrar">Situación fiscal:</span><span>Responsable Inscripto</span><br></br>
              <span>Inscripción R.P.A:</span><span>{{ $admin->rpa}}</span>
             </div> 
             

            
             



             <div id="consorcio">
              <span class="title-green">CONSORCIO</span><br></br>
              <span>Razon Social:</span><span>{{ $edificio->razon_social }}</span><br></br>
              <span>Direccion:</span><span>{{ $edificio->direccion }}</span><br></br>
              <span>Localidad:</span><span>San Justo</span><br></br>
              <span>Provincia:</span><span>Buenos Aires</span><br></br>
              <span>Cuit:</span><span>{{ $edificio->cuit }}</span><br></br>
              <span>Clave SUTHERH:</span><span>{{ $edificio->suterh }}</span>
              <span>Administrador:</span><span>{{ $admin->razon_social }}</span>
             </div>





  </div><br></br>



          <div id="cuenta-container">
              <div id="cuenta-title" class="fondo-green">ESTADO DE CUENTAS Y PRORRATEO</div>
              
              <table class="boldtable">
                 
                 <tr><td class="head-table">PISO</td><td class="head-table">UNIDAD</td><td class="head-table " >PROPIETARIO</td><td class="head-table" colspan="3">PORCENTAJE(%)</td><td class="head-table">METROS(mts²)</td><td class="head-table">IMPORTE</td></tr>
                 @if (count($pisos)!=0)  
                  @foreach ( $pisos as $p )
                 <tr><td>{{ $p->numero }}</td><td>{{ $p->letra }}</td><td class="pro">{{ $p->propietario }}</td><td colspan="3">{{ $p->porcentaje }}</td><td>{{ $p->metros }}</td><td >{{ $p->importe }}</td></tr>
                 @endforeach
                 @else
                           <tr>
                             <td colspan="6" align="center">No se encontraron registros.</td>
                           </tr>
                 @endif
            </table>  



        </div>








</div><!--end container-->










