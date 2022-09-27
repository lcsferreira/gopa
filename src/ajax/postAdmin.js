$(function () {
  $('#adm-name').on('input change', function() {
    console.log("entrou")
    if($(this).val() != '') {
        $('#saveadmin').prop('disabled', false);
    } else {
        $('#saveadmin').prop('disabled', true);
    }
  });

  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();

    if(admEmail === "" || admName === ""){
      console.log("Error")
    }else{
      let request = $.ajax({
        method: "POST",
        url: "../../ajaxquery/saveadmin_ajax.php",
        data: { name: admName, email: admEmail },
        dataType: "text",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
      });
      
      // Callback handler that will be called on success
      request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log(response)
        console.log("admin created!!!!!");
      });
      
      // Callback handler that will be called on failure
      request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
          "The following error occurred: "+
          textStatus, errorThrown
          );
        });
      }
  });
});
