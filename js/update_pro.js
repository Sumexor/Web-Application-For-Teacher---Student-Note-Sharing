$(document).ready(function(){
    $("#updatepro").click(function(){
        var type = $("#typetxt").val();
        var id = $("#useridtxt").val();
        var email = $("#emailtxt").val();
        var name = $("#nametxt").val();
        var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         
        }
      }
      xmlhttp.open("GET", "update.php?type="+type+"&id="+id+"&emailtxt="+email+"&name="+name, true);
      xmlhttp.send();
    });
});