$(document).ready(function(){
    $(".adbn").click(function(){
        var data = $(this).attr('id').toString().split('~');
        var str = $(this).text();
        if(str.includes("playlist_add_check")){
          $(this).empty();
          $(this).append("<i class='material-icons'>playlist_add</i>");
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
        }
      }
      xmlhttp.open("GET", "delete_notes_s.php?note_name="+data[0]+"&teacher="+data[1], true);
      xmlhttp.send();
      var concat = data[0].replace(/\ /g,"_") + "~" + data[1].replace(/\ /g,"_");
      $("#listitem").remove(":contains("+data[0]+")");
      if ($('#noteslist').is(':empty')){
          $('#noteslist').append("<h5 class='text-muted'>No Notes found!</h5>");
      }
        }else{
          $(this).empty();
          $(this).append("<i class='material-icons'>playlist_add_check</i>");
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
        }
      }
      xmlhttp.open("GET", "add_notes_s.php?note_name="+data[0]+"&teacher="+data[1], true);
      xmlhttp.send();
      if($("#noteslist h5").length>0){
        $("#noteslist h5").remove();
      }
      $("#noteslist").append("<div id='listitem'> <div class='input-group mb-3' id='"+data[0].replace(/\ /g,"_")+"~"+data[1].replace(/\ /g,"_")+"'><div class='input-group-prepend'><div class='input-group-text'><input type='checkbox'> </div></div><a href='view_notes_s.php?note="+data[0]+"&teacher="+data[1]+"' class='form-control'>"+data[0]+"</a></div></div>");
        }
    });
  
    $(".sharebtn").click(function(){
      var data = $(this).attr('id').toString().split('~');
      var link = "localhost/site/g_view_notes.php?note=" + data[0] + "&teacher=" +data[1];
      $("#sharelink").val(link);
    });
  
    $("#copytxt").click(function(){
      $("#sharelink").select();
      document.execCommand("copy");
    });

    $('[data-toggle="popover"]').popover();
  });