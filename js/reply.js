$(document).ready(function(){
    $("#replybtn").click(function(){
        var reply = $("#replytxt").val();
        var student = $("#studenttxt").val();
        var teacher = $("#teachertxt").val();
        var note = $("#notetxt").val();
        alert(reply + student + teacher +note);
        var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         
        }
      }
      xmlhttp.open("GET", "reply.php?reply="+reply+"&student="+student+"&teacher="+teacher+"&note="+note, true);
      xmlhttp.send();
      $("#replytxt").remove();
      $("#replybtn").remove();
      $("#replydiv").append("<div class='border'><b>Reply:- </b>"+reply+"</div>");
    });
});