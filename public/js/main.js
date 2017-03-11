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
  function checkDeadline(){
    if (!actions) {
      console.log("No actions today");
      return;
    }
    else {
    // get time now
    var nowTime = new Date();
    var nowHours = ('0'+nowTime.getHours()).slice(-2);
    var nowMinutes = ('0'+nowTime.getMinutes()).slice(-2);
    var comparableTime = nowHours + ":" + nowMinutes + ":00";
    console.log(comparableTime);
    // iterate trough all today tasks
    $.each(actions, function(p, v){
      if (v.due_time === comparableTime) {
       createNotification(v.title, v.content);
      }
      else {
        console.log("nah");
      }
    });
    }
  }
    function createNotification(title, content) {
    // Let's check if the browser supports notifications
    var img = 'https://www.softaculous.com/website/images/customlogo.gif';
    if (!("Notification" in window)) {
      alert("This browser does not support system notifications");
    }
    // Let's check whether notification permissions have already been granted
    else if (Notification.permission === "granted") {
      // If it's okay let's create a notification
      var n = new Notification(title, { body: content, icon: img });
      setTimeout(function() { notification.close() }, 1000*60*60*8);
    }

    // Otherwise, we need to ask the user for permission
    else if (Notification.permission !== 'denied') {
      Notification.requestPermission(function (permission) {
        // If the user accepts, let's create a notification
        if (permission === "granted") {
          var n = new Notification(title, { body: content, icon: img });
          setTimeout(function() { notification.close() }, 1000*60*60*8);
        }
      });
    }
    // Finally, if the user has denied notifications and you
    // want to be respectful there is no need to bother them any more.
  }
  setInterval(checkDeadline, 1000*60);
});
