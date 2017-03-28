$(document).ready(function(){
  $(".deleteLink").on("click", function(e){
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
      $this.closest("tr").fadeOut("slow", function(){
        $this.remove();
      });
    });
  });
  $("#addButton").on("click", function(e){
    $("#addUserForm").children(".form-group").children("div").html("");
    e.preventDefault();
    $(".passError").removeClass("showError");
    if ($("input[name='password']").val() !== $("input[name='password2']").val()){
      e.stopPropagation();
      return togglePassError();
    }
    else{
      var formData = $("#addUserForm").serialize();
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        type: 'POST',
        url: $("#addUserForm").attr("action"),
        data: formData,
        error: function(data){
          var res = data.responseJSON;
          $.each(res, function(attr, arr){
            $("."+attr).html("<span>"+arr+"</span>");
          });
        },
        success: function(){
        $('#addUserModal').modal('toggle');
        }
      })
      .done(function(data){
        console.log(data);
      });
    }
  });
  function togglePassError(){
    $(".passError").addClass("showError");
  }
});
