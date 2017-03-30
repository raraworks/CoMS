$(document).ready(function(){

  $(document).on("click", "#addTaskButton", function(e){
    e.preventDefault();
    tinyMCE.triggerSave();
    var formData = $("#addTaskForm").serialize();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type: 'POST',
      url: $("#addTaskForm").attr("action"),
      data: formData,
      error: function(data){
        var res = data.responseJSON;
        $.each(res, function(attr, arr){
          $("#error1").html("<span>"+arr+"</span>");
        });
      },
      success: function(){
      $('#addUserModal').modal('toggle');
      },

    })
    .done(function(data){
      console.log(data);
      $("#taskRow").prepend(data);
    });
  });
});
$(document).on('focusin', function(e) {
if ($(e.target).closest(".mce-window").length) {
  e.stopImmediatePropagation();
}
});
