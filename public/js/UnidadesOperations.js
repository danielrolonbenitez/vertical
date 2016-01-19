/* Función para completar el modal de eliminar Unidad con los datos existentes */
$('button.delete').on('click', function() {
    var UnidadDeleteModal = $('#UnidadDeleteModal');
    var unidad_i = $(this).closest('tr').find('td.unidad_i').html();
    DeleteForm.action = 'http://www.clusterix.com.ar/vertical/public/unidades/'+unidad_i;
    UnidadDeleteModal.modal({ show: true });
    return false;
});

/* Función para completar el modal de edición de Unidades con los datos existentes */
$('button.edit').on('click', function() {
    var UnidadEditModal = $('#UnidadEditModal');
    var piso = $(this).closest('tr').find('td.unidad_n').html();
    var unidad = $(this).closest('tr').find('td.unidad_i').html();
    var letra = $(this).closest('tr').find('td.unidad_l').html();
    var porcentaje = $(this).closest('tr').find('td.unidad_p').html();
    var metros = $(this).closest('tr').find('td.unidad_m').html();
    var Piso = document.getElementById("piso_id_e");
    var Unidad = document.getElementById("unidad_id_e");
    var Letra = document.getElementById("letra_e");
    var Porcentaje = document.getElementById("porcentaje_e");
    var Metros = document.getElementById("metros_e");
    Piso.value = piso;
    Unidad.value = unidad;
    Letra.value = letra;
    Porcentaje.value = porcentaje;
    Metros.value = metros;
    EditForm.action = 'http://www.clusterix.com.ar/vertical/public/unidades/'+unidad;
    UnidadEditModal.modal({ show: true });
    return false;
});

/* Función para completar el modal de edición de Amenities con los datos existentes */
$('button.edit_amenitie').on('click', function() {
    var AmenitieEditModal = $('#AmenitieEditModal');
    var id = $(this).closest('tr').find('td.amenitie_i').html();
    var descripcion = $(this).closest('tr').find('td.amenitie_d').html();
    var Descripcion = document.getElementById("descripcion_e");
    Descripcion.value = descripcion;
    AmenitieEditForm.action = AmenitieEditForm.action+'/'+id;
    AmenitieEditModal.modal({ show: true });
    return false;
});

/* Función para completar el modal de eliminar Amenitie con los datos existentes */
$('button.delete_amenitie').on('click', function() {
    var AmenitieDeleteModal = $('#AmenitieDeleteModal');
    var id = $(this).closest('tr').find('td.amenitie_i').html();
    AmenitieDeleteForm.action = 'http://www.clusterix.com.ar/vertical/public/amenities/'+id;
    AmenitieDeleteModal.modal({ show: true });
    return false;
});