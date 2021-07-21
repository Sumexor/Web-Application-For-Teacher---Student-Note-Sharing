$(document).ready(function(){
    $("#getfeed").click(function(){
        var feed = $("#feedtext").val();
        var teacher = $("#teacherid").val();
        var student = $("#studentid").val();
        var note = $("#note").val();
        var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         
        }
      }
      xmlhttp.open("GET", "insert_feedback.php?feedback="+feed+"&id="+student+"&teacher="+teacher+"&note="+note, true);
      xmlhttp.send();
      $("#feediv").empty();
      $("#feediv").append("<b><h5 class='ml-3'><i class='material-icons' >person</i> "+student+"</h5></b>");
      $("#feediv").append("<h6 class='ml-4'>"+feed+"</h6>");
    });
});