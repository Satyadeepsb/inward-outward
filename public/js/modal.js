
$('#deleteUser').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var user_id = button.data('userid');
    console.log(user_id);
    var modal = $(this);
/*    modal.find('.modal-title').text('New message to ' + recipient);
    modal.find('.modal-body input').val(recipient);*/
    modal.find('.modal-body #user_id').val(user_id);
});

$(function() {
    openDatePicker();
});

$('#cal2').click(function(){
    $(document).ready(function(){
        $('#myDatePickerId').datepicker().focus();
    });
});
function openDatePicker() {
    console.log('clicked');
    $('#myDatePickerId').datepicker();
}