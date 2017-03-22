$(document).ready(function(){
  $("#searchButton").on("click", function(e){
    e.preventDefault();
    var vars = [], hash;
    var q = document.URL.split('?')[1];
    if(q !== undefined){
        q = q.split('&');
        for(var i = 0; i < q.length; i++){
            hash = q[i].split('=');
            vars.push(hash[1]);
            vars[hash[0]] = hash[1];
        }
    }
    var formFields = "id=" + vars.id + "&"+$('#searchForm input').map(function () {
        return $(this).val().trim() === "" ? null : this;
    }).serialize();
    console.log(formFields);
    $.ajax({
      type: 'get',
      url: url,
      data: formFields,
      success: function(response) {
        console.log(response);
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
          $("#tabula").closest("table").show();
          $("#contentRow").children("div.text-center").remove();
          toTable();
        }
        else {
            $("#tabula").closest("table").hide();
            $("#contentRow").append("<div class=\"text-center\"><h2> Darbību nav </h2></div>  ");
            toTable();
        }
      }
      function toTable(){
        $("#contentRow").fadeIn("slow");
      }
    });
  });
});
