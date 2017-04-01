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
      $('#addTaskModal').modal('toggle');
      },

    })
    .done(function(data){
      console.log(data);
      $("#taskRow").prepend(data);
    });
  });
  $(document).on("click", "#addAttachButton", function(e){
    $("#addAttachForm").submit();
  });
  $("#addAttachForm").on("submit", function(e) {
    e.preventDefault();
    var formData = new FormData();
    var len = document.getElementById('file').files.length;
    console.log(len);
    for (var i = 0; i < len; i++) {
            formData.append("attachments[]", document.getElementById('file').files[i]);
            console.log(document.getElementById('file').files[i]);
    }
    for(var pair of formData.entries()) {
      console.log(pair[0]+ ', '+ pair[1]);
    }
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type: 'POST',
      enctype: 'multipart/form-data',
      url: $("#addAttachForm").attr("action"),
      data: formData,
      processData: false,
      contentType: false,
      error: function(data){
        console.log(data);
      },
      success: function(){
      $('#addAttachModal').modal('toggle');
      },

    })
    .done(function(data){
      console.log(data);
      $("#attachRow").prepend(data);
    });
  });
  //ajax calls for deleting user, DELEGATED events
  $("#taskRow").on("click", ".deleteLink", function(e){
    e.preventDefault();
    var $this = $(this);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type: 'DELETE',
      url: $this.attr("href")
    })
    .done(function(data){
      console.log(data);
      $this.closest(".col-sm-4").fadeOut("slow", function(){
        $this.remove();
      });
    });
  });
  //ajax calls for deleting attachment, DELEGATED events
  $("#attachRow").on("click", ".deleteAttachLink", function(e){
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type: 'DELETE',
      url: $this.attr("href")
    })
    .done(function(data){
      console.log(data);
      $this.closest(".col-sm-2").fadeOut("slow", function(){
        $this.remove();
      });
    });
  });
});
$(document).on('focusin', function(e) {
if ($(e.target).closest(".mce-window").length) {
  e.stopImmediatePropagation();
}
});
