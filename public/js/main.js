$( document ).ready(function() {
  $(".kontrole").on("click", function(){
    var attr = $(this).attr("id");
    console.log(attr);
    $("#infobox").children().slideUp("fast");
    $("#controlRow").children().removeClass("activated");
    switch (attr) {
        case "kontakti":
        doActions("#kontaktu-ramis", attr);
          break;
        case "darbibas":
        doActions("#darbibu-ramis", attr);
          break;
        case "info":
        doActions("#info-ramis", attr);
          break;
        default:
      }
  });
  function doActions(idi, attr) {
    if ($(idi).is(":hidden")) {
      $(idi).slideDown("fast");
      $("#controlRow").find("#" + attr).addClass("activated");
    }
    else {
      $("#controlRow").find("#" + attr).removeClass("activated");
    }
  }
  $("#loginpanel").fadeIn(1000);
  $(".deleteButton").on("click", function(){
    alert("Vai tiešām vēlaties izdzēst šo ierakstu?");
  });
  
  //Remove alert after 2.5 seconds
  setTimeout(function(){
    $(".alert").fadeOut("slow", function(){
      $(this).remove();
    });
  }, 2500);
});
