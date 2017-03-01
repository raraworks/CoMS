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
        $(this).closest("tr.indextabula").addClass("lessThanHour")
      }
    });
  function notifyMe() {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support system notifications");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    var notification = new Notification("Hi there!");
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {
        var notification = new Notification("Hi there!");
      }
    });
  }
  // Finally, if the user has otidenied notifications and you
  // want to be respectful there is no need to bother them any more.
  }
  $("#notify").on("click", function(){
      notifyMe();
  });

});
