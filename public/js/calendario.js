
 $date = new Date();
 $d = $date.getDate();
 $m = $date.getMonth()+1;
$y = $date.getFullYear();
$fecha=$y+"-"+$m+"-"+$d;




  $('#calendar').fullCalendar({
    theme: true,
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    defaultDate: $fecha,
    editable: false,
    eventLimit: true,
    lang: 'es',
    // JSON FEED INSTRUCTIONS
    //
    // 1. Open a new browser tab. Go to JSBin again.
    //
    // 2. Reveal the JavaScript panel. Paste your JSON.
    //
    // 3. An auto-save will happen. The tab's new URL will look like this:
    //    http://jsbin.com/hodode/1/edit
    //
    // 4. Remove the "/edit" part and add ".js". Will look like this:
    //    http://jsbin.com/hodode/1.js
    //
    // 5. Paste this URL below.
    //
    events: {
        url: '/vertical/public/eventosjson',
        error: function() {
          console.log("error");
        }
      },
       
    eventClick: function(calEvent, jsEvent, view) {
        //$('#EventoInfoModal').modal('show'); 
      window.location.href="http://www.clusterix.com.ar/vertical/public/eventos/"+calEvent.id;

     // $("#titulo").html(calEvent.title);
      //$("#descripcion").html(calEvent.descripcion);

        //$("#hora").html(calEvent.hora);
        //$("#duracion").html(calEvent.descripcion);

    
    //$id=calEvent.id;
    //$act= $("#EventDeleteForm").attr("action");
    //$eliminar="eventos/"+$id;
    //$("#EventDeleteForm").attr("action",$eliminar);
        }
  });
