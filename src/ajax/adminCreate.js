$(document).ready(function () {
  validateInputs();
  postAdmin();
});

function validateInputs() {
  $(".form").keyup(function () {
    console.log($("#adm-email").val());
    console.log($("#adm-name").val());

    if ($("#adm-email").val() !== "" && $("#adm-name").val() !== "") {
      $("#saveadmin").removeAttr("disabled");
    } else {
      $("#saveadmin").attr("disabled", "disabled");
    }
  });
}

function postAdmin() {
  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxquery/saveadmin_ajax.php",
      data: { name: admName, email: admEmail },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
      setTimeout(() => {
        window.location.href = "../adminList/adminList.php";
      }, 1000);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
      // Log the error to the console
      console.error("The following error occurred: " + textStatus, errorThrown);
    });
  });
}
