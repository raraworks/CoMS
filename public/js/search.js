$(document).ready(function (){
  $("#searchIcon").on("click", function(){
    $searchvalue = $("seerch").val();
      if ($.trim("searchvalue") !== '') {
        $.ajax({
          type: 'get',
          url: '/search',
          data: {searchvalue: $searchvalue}
        })
          .done(function(data){
            console.log(data);
          });
        // $.get("/search", {searchvalue: searchvalue}, function(data){
        //   console.log(data);
        // });
      }
  });
});
