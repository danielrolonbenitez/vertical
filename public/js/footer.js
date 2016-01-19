
$( document ).ready(function() {
  $('.oculta').hide();


$(".o").click(function(){
$angulo=$(this).getRotateAngle();
$x=$(this).next();
 $y=$x.next();

if($angulo==-180)
{
$(this).rotate({angle: -360,animate:-360});
$y.toggle("slow");
}



  else{$(this).rotate({angle: -180,animate:-180});

  $y.toggle("slow");
}



/*codigo para volver a su estado original*/









});/*cierra function*/












});/*cierra document*/
