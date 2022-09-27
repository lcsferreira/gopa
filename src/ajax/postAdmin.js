$(function(){
  $("#saveadmin").on('click', function(){
      var admName = $("#adm-name").val();
      var admEmail = $("#adm-email").val();
      $.ajax({
        method: "POST",
        url:    "../../ajaxquery/saveadmin_ajax.php",
        data: { "name": admName, "email": admEmail, "password": "123"},
        dataType:'json',
        type:'post',
        contentType: 'application/x-www-form-urlencoded',
      })
 });
});