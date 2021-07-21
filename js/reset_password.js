$(document).ready(function(){
    $("#updatepro").click(function(){
        var type = $("#typetxt").val();
        var id = $("#useridtxt").val();
        var pass = $("#passtxt").val();
        
        var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         
        }
      }
      xmlhttp.open("GET", "reset_pass.php?type="+type+"&id="+id+"&emailtxt="+email+"&name="+name, true);
      xmlhttp.send();
    });
});