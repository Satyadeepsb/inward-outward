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
    var modal = $(this);
    modal.find('.modal-body #inward_id').val(application.inward_no);
    modal.find('.modal-body #inward_id_display')[0].innerHTML = application.inward_no;
    modal.find('.modal-body #application_name_display')[0].innerHTML = application.name;
    modal.find('.modal-body #status_display')[0].innerHTML = application.status;
    modal.find('.modal-body #date_display')[0].innerHTML = application.date;
    modal.find('.modal-body #documents_display')[0].innerHTML = application.documents;
});


$(function () {
    openDatePicker();
});

var datePickerOptions = {
    format: 'yyyy-mm-dd',
    autoclose: true
};

$('#cal2').click(function () {
    $(document).ready(function () {
        $('#date').datepicker(datePickerOptions).focus();
    });
});

function openDatePicker() {
    $('#date').datepicker(datePickerOptions);
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
$('.bulk-action').on('click', function (e) {


    var allVals = [];
    $(".sub_chk:checked").each(function () {
        allVals.push($(this).attr('data-id'));
    });

    if (allVals.length <= 0) {
        toastr.error("Please Select Application");
    }else{
        var myModal =  $('#bulkModal');
        myModal.modal('show');
        myModal.find('.modal-body #appIds').val(allVals);
    }
});

$('#select-all').on('click', function(e) {
    if($(this).is(':checked',true))
    {
        $(".sub_chk").prop('checked', true);
    } else {
        $(".sub_chk").prop('checked',false);
    }
});


