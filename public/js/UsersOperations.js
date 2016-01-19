$('button.delete').on('click', function() {
    var UserDeleteModal = $('#UserDeleteModal');
    var user_d_i = $(this).closest('tr').find('td.user_i').html();
    DeleteForm.action='http://www.clusterix.com.ar/vertical/public/users/'+user_d_i;
    UserDeleteModal.modal({ show: true });
    return false;
});