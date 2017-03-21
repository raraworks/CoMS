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
        return $(this).val().trim() == "" ? null : this;
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
  });
});
