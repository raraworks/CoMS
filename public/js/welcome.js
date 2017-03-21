$(document).ready(function(){
  $(".indextabula").each(function(){
    $(this).checkTaskStatus();
  });
  $("#todayTable").fadeIn(500, function(){
    $("#soonTable").fadeIn(500, function () {
      $("#pastTable").fadeIn(500);
    });
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
    var img = 'http://www.ika.lv/wp-content/uploads/2016/05/IKA_logo.png';
    if (!("Notification" in window)) {
      alert("This browser does not support system notifications");
    }
    // Let's check whether notification permissions have already been granted
    else if (Notification.permission === "granted") {
      // If it's okay let's create a notification
      var n = new Notification(title, { body: content, icon: img });
      setTimeout(function() { notification.close(); }, 1000*60*60*8);
    }

    // Otherwise, we need to ask the user for permission
    else if (Notification.permission !== 'denied') {
      Notification.requestPermission(function (permission) {
        // If the user accepts, let's create a notification
        if (permission === "granted") {
          var n = new Notification(title, { body: content, icon: img });
          setTimeout(function() { notification.close(); }, 1000*60*60*8);
        }
      });
    }
    // Finally, if the user has denied notifications and you
    // want to be respectful there is no need to bother them any more.
  }
  setInterval(checkDeadline, 1000*60);

  $(".checkButton").on("click", function(){
    var uzd = $(this);
    $.ajax({
      type: 'POST',
      url: '/actions/'+uzd.attr("data-iden"),
      data: {
        _method: 'PUT',
        done: uzd.attr("data-isdone"),
        dataType: "json",
        _token: token
      }
    })
      .done(function(data){
        console.log(data);
        uzd.attr("data-isdone", data.isDone);
        if (data.isDone == 1) {
          uzd.closest(".indextabula").addClass("strikeTrough").checkTaskStatus();
        }
        else {
          uzd.closest(".indextabula").removeClass("strikeTrough").checkTaskStatus();
        }
      });
  });

});

$.fn.checkTaskStatus = function(){
  if (this.hasClass("strikeTrough")) {
    this.children(".isDoneButton").children(".checkButton").attr("data-isdone", 1).removeClass("btn-primary").addClass("btn-warning").text("Atzīmēt kā nepabeigtu");
    return this;
  }
  else {
    this.children(".isDoneButton").children(".checkButton").attr("data-isdone", 0).addClass("btn-primary").removeClass("btn-warning").text("Atzīmēt kā pabeigtu");
    return this;
  }
};
