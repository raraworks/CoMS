$( document ).ready(function() {
    $(".kontrole").on("click", function(){
      var attr = $(this).attr("id");
      console.log(attr);
      $("#infobox").children().slideUp("fast");
      switch (attr) {
          case "kontakti":
          doActions("#kontaktu-ramis");
            break;
          case "darbibas":
          doActions("#darbibu-ramis");
            break;
          case "info":
          doActions("#info-ramis");
            break;
          default:
        }
    });
    function doActions(idi) {
      if ($(idi).is(":hidden")) {
        $(idi).slideDown("fast");
      }
    }
    $("#loginpanel").fadeIn(1000);
    $(".deleteButton").on("click", function(){
      alert("Vai tiešām vēlaties izdzēst šo ierakstu?");
    });
});
