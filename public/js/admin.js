$(document).ready(function(){
  //ajax calls for deleting user, DELEGATED events
  $("#userTable").on("click", ".deleteLink", function(e){
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
  //ajax calls for changing user roles, DELEGATED events
  $("#userTable").on("click", "input[type=checkbox]", function(){
    var checkStatus = $(this).is(":checked");
    var role = $(this).attr("name");
    var userEmail = $(this).closest("tr").children(':nth-child(3)').html();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type: "PUT",
      url: "/admin/users",
      data: {
        role: role,
        status: checkStatus,
        email: userEmail
      },
    });
  });
  //ajax call for showing modal form to add a user to system
  $("#addButton").on("click", function(e){
    $("#addUserForm").children(".form-group").children("div").not(".passError").html("");
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
        $("#userTable").fadeOut("slow", function(){
          $(".indextabula").remove();
          $("#userTable").append(data, $("#userTable").fadeIn("slow"));
        });
      });
    }
  });
  function togglePassError(){
    $(".passError").addClass("showError");
  }
});
