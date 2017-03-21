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
  var time = new Date();
  var timeH = time.getHours();
  var timeM = time.getMinutes();
  $(".taim").each(function(){
    var htmlTime = $(this).text();
    if (htmlTime.substr(0,2) == timeH) {
      $(this).closest("tr.indextabula").addClass("lessThanHour");
    }
  });
});
