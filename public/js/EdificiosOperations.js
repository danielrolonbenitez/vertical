$('button.delete').on('click', function() {
    var DeleteModal = $('#DeleteModal');
    var edificio_d_i = $(this).closest('tr').find('td.edificio_i').html();
    DeleteForm.action = 'http://www.clusterix.com.ar/vertical/public/edificios/'+edificio_d_i;
    DeleteModal.modal({ show: true });
    return false;
});


$('button.message').on('click', function() {
    var MessageModal = $('#MessageModal');
    var edificio_d_i = $(this).closest('tr').find('td.edificio_i').html();
    MessageForm.action = 'http://www.clusterix.com.ar/vertical/public/edificios/message/'+edificio_d_i;
    MessageModal.modal({ show: true });
    return false;
});