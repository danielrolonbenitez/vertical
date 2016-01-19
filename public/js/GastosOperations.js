$('button.delete').on('click', function() {
    var DeleteModal = $('#DeleteModal');
    var gasto_i = $(this).closest('tr').find('td.gasto_i').html();
    DeleteForm.action = 'http://www.clusterix.com.ar/vertical/public/gastos/'+gasto_i;
    DeleteModal.modal({ show: true });
    return false;
});