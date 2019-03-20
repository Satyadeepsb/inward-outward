$('#deleteUser').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var user_id = button.data('userid');
    var modal = $(this);
    /*    modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('.modal-body input').val(recipient);*/
    modal.find('.modal-body #user_id').val(user_id);
});

$('#paEditModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var application = button.data('application');
    var modal = $(this);
    modal.find('.modal-body #inward_id').val(application.inward_no);
    modal.find('.modal-body #inward_id_display')[0].innerHTML = application.inward_no;
    modal.find('.modal-body #reference_no_display')[0].innerHTML = application.reference_no;
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

var form = document.getElementById('uploadForm');
var request = new XMLHttpRequest();
if(form){
    form.addEventListener('submit', function (e) {
        console.log('submitted');
        e.preventDefault();
        var formData = new FormData(form);
        request.open('post', '/application/save-remark');
        request.addEventListener('load', transferComplete);
        request.send(formData);
    });
}

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

$('.save-setting').on('click', function (e) {
    var allVals = [];
    $(".setting_chk:checked").each(function () {
        allVals.push($(this).attr('data-name'));
    });
    console.log(allVals);
    var form = document.getElementById('settingsForm');
    var request = new XMLHttpRequest();
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(form);
        formData.append('email', 1);
        formData.append('sms', 0);
        console.log(formData);
        request.open('post', '/super/settings/update');
        // request.addEventListener('load', transferComplete);
        request.send(formData);
    });
});

$('#select-all').on('click', function(e) {
    if($(this).is(':checked',true))
    {
        $(".sub_chk").prop('checked', true);
    } else {
        $(".sub_chk").prop('checked',false);
    }
});

$('.dynamic').change(function(){
    if($(this).val() != '')
    {
        var select = $(this).attr("id");
        var value = $(this).val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"/application/fetch",
            method:"POST",
            data:{select:select, value:value, _token:_token, dependent:dependent},
            success:function(result)
            {
                $('#taluka').html(result);
            }
        })
    }
});
$('#dept').change(function(){
    if($(this).val() != '')
    {
        var select = $(this).attr("id");
        var value = $(this).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"/application/byDepartment",
            method:"POST",
            data:{ value:value, _token:_token},
            success:function(result)
            {

            }
        })
    }
});

$('#district').change(function(){
    $('#taluka').val('');
});
