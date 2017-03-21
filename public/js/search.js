$(document).ready(function (){
  $(document).ajaxStart(function(){
    $(".loadingIcon").show();
  });
  $(document).ajaxStop(function(){
    $(".loadingIcon").hide();
  });
  $("#searchIcon").on("click", function(e){

    e.preventDefault();
    $searchvalue = $("#term").val();
    console.log($searchvalue);
      if ($.trim($searchvalue) !== '') {
        // var dataToSend = "term="+$searchvalue;
        $.ajax({
          type: 'get',
          url: 'contacts/search',
          data: {
            term: $searchvalue
          },
          success: function (response){
            console.log("You just sent a value to server");
          },
          error: function (error){
            console.log(error);
          }
        })
          .done(function(data){
            $("#contentRow").fadeOut("slow", function(){
              $(".indextabula").remove(appendTable());

            });
            function appendTable() {
              if (!$.isEmptyObject(data)) {
                console.log(data);
                $("#tabula").append(data);
                toTable();

                // $.each(data, function(index, value){
                //
                //   // console.log(value);
                //   // rowAdd(value);
                // });
              }
              else {
                  $("#tabula").append("<h1> Tādu kontaktu nav </h1>");
                  toTable();
              }
            }
            function toTable(){
              $("#contentRow").fadeIn("slow");
            }
          });
            // if (!$.isEmptyObject(data)) {
            //   $.each(data, function(index, value){
            //     // console.log(value);
            //     rowAdd(value);
            //   });
            //   $("tbody").slideDown(400);
            // }
            // else {
            //   console.log("no data");
            // }
        // $.get("/search", {searchvalue: searchvalue}, function(data){
        //   console.log(data);
        // });
      }
      else {
        $(".loadingIcon").text("Lūdzu ievadi vismaz vienu parametru, lai notiktu meklēšana");
        $('.loadingIcon').animate({opacity:1, visibility:'visible'}, 200);

      }
  });
});
