function ajax_validation(xhr){
    let errors = $.parseJSON(xhr.responseText);
    for (const [key, value] of Object.entries(errors.errors)) {
        $(`#${key}`).addClass('is-invalid');
        $(`#${key}`).focus();
        $(`#${key}_invalid`).html(value);
    }

}


function button_disable(button_id){
    $("#"+button_id).prop('disabled', true);
}

function button_enable(button_id){
    $("#"+button_id).prop('disabled', false);
}

function reload_datatable(table_id){
    $("#"+table_id).DataTable().ajax.reload();
}

function form_reset(form_id){
  $('#'+form_id).trigger("reset");
  var select2 = $('#'+form_id).find(".select2");
  var update_id = $('#'+form_id).find("input[name='update_id']");
  if(update_id){
    $("input[name='update_id']").val('');
  }
  if(select2){
    $(".select2").val('').trigger('change');
  }
  
}

function toastr_success(){
    toastr.success('Operation successful !!', 'Success!');
}
function toastr_error(){
  toastr.error('Operation Unsuccessful !!', 'Error!')
}

function remove_validation_error(){
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
}

function ajax_form_submit(form_id, route_name){
  
  $('#'+form_id).on('submit', (e) => {
      e.preventDefault();
      remove_validation_error();
      let form_data = new FormData($('#'+form_id)[0]);
      $.ajax({
          type: 'POST',
          enctype: 'multipart/form-data',
          url: route_name,
          data: form_data,
          cache: false,
          processData: false,
          contentType: false,
          timeout: 60000,
          beforeSend:function(){
              button_disable('save');
          },
          success: function (response){
            $("#report").css('visibility', 'visible');
            var data = JSON.parse(response);
              toastr_success();
              form_reset(form_id);
              button_enable('save');
              reload_datatable('datatable');
              $("#total_data").html(data.total_data);
              $("#total_successful_uploaded").html(data.total_successful_uploaded);
              $("#total_duplicate").html(data.total_duplicate);
              $("#total_invalid").html(data.total_invalid);
              $("#total_incomplete").html(data.total_incomplete);
          },
          error: function (xhr, status, error){
              button_enable('save');
              ajax_validation(xhr);
              toastr_error();
          }
      });
  });
}
