/*set of color the messagge that have estate not read */
$(document).ready(function(){

$(".user_r:contains('No Leido')").css("color","blue");




});
/* Función para completar el modal de eliminar con los datos existentes */

$('button.delete').on('click', function() {
    var UserDeleteModal = $('#UserDeleteModal');
    var user_d_i = $(this).closest('tr').find('td.user_i').html();
    DeleteForm.action = 'http://www.clusterix.com.ar/vertical/public/contactos/'+user_d_i;
    UserDeleteModal.modal({ show: true });
    return false;
});


/*funcion para cargar edit */

$('button.edit').on('click', function() {
    

    // Get the values from the table
    $id=$(this).closest('tr').find('td.user_i').html();
    $mensaje =$(this).closest('tr').find('td.men').html();
    $de =$(this).closest('tr').find('td.user_e').html();
    $asunto=$(this).closest('tr').find('td.user_l').html();
 

    //llamo a los elementos del modal para setearle los valores posteriormente
   
    // Set them in the modal:
        $('#mensaje_name').html($mensaje);
        $('#mensaje_email').html($de);
        $('#mensaje_asunto').html($asunto);
        $('#idm').val($id);
        /*send if for editEstate method*/

 

});