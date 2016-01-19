
/* Función para completar el modal de edición con los datos existentes */

$('button.edit').on('click', function() {
    var RolEditModal = $('#RolEditModal');

    // Get the values from the table
    var rol_e_id = $(this).closest('tr').find('td.rol_i').html();
    var rol_e_name = $(this).closest('tr').find('td.rol_n').html();

    var RolName = document.getElementById("e_name");

    // Set them in the modal:
    //$('#rol_e').html(rol_e_e);
    RolName.value = rol_e_name;
    EditForm.action = EditForm.action+'/'+rol_e_id;

    // Show the modal
    RolEditModal.modal({ show: true });
    return false;
});