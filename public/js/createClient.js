$(document).ready(function(){
  $("#addBox").on("click", function(){
    if (!$(".addContact").is(':visible')){
      $(".addContact").slideDown("slow", function(){
        $(this).css("display", "block");
      });
    }
    else {
      $(".addContact").slideUp("slow", function(){
        $(this).css("display", "none");
      });
    }
  });
});
