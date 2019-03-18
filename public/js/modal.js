
$('#deleteUser').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var user_id = button.data('userid');
    var modal = $(this);
/*    modal.find('.modal-title').text('New message to ' + recipient);
    modal.find('.modal-body input').val(recipient);*/
    modal.find('.modal-body #user_id').val(user_id);
});

$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var application = button.data('application');
    var action = button.data('action');
    console.log(action);
    console.log(application);
    var modal = $(this);
    /*    modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('.modal-body input').val(recipient);*/
    modal.find('.modal-body #application').val(application);
    modal.find('.modal-body #action').val(action);
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
    $('#myDatePickerId').datepicker();
}
function transferComplete(data) {
    console.log(data.currentTarget.response);
}
/*
var form = document.getElementById('uploadForm');
var request = new XMLHttpRequest();
form.addEventListener('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(form);
    request.open('post', '/application/createNew');
    request.addEventListener('load', transferComplete);
    request.send(formData);
});*/
