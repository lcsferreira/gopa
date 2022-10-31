$(document).ready(function () {
  $("#email-error").hide();
  $("#name-error").hide();
  validateInputs();
  postAdmin();
  validateEmail();
});

function validateInputs() {
  $(".form").keyup(function () {
    $('input[type="text"]').each(function () {
      if ($(this).val() === "") {
        $("#saveCountry").attr("disabled", "disabled");
      } else {
        $("#saveCountry").removeAttr("disabled");
      }
    });
  });
}

function validateEmail() {
  $("#adm-email").on("keyup", function () {
    let email = $("#adm-email").val();
    if (email.includes("@")) {
      $("#email-error").hide();
      $("#saveadmin").removeAttr("disabled");
      $("#adm-email").removeClass("is-invalid");
    } else {
      $("#email-error").show();
      $("#saveadmin").attr("disabled", "disabled");
      $("#adm-email").addClass("is-invalid");
    }
  });
}

window.onunload = function () {
  closeModal();
};

function showModal(msg) {
  // Get the modal
  var modal = document.getElementById("modalError");
  modal.style.display = "block";
  //disable pointer events on the id="main" element except for the modal
  //create a p inside the modal-body with the msg
  $("#modalError .modal-body").append("<p>" + msg + "</p>");

  document.getElementById("main").style.pointerEvents = "none";
  //enable pointer events on the modal
  document.getElementById("modalError").style.pointerEvents = "auto";
}

function closeModal() {
  // Get the modal
  $("#cancel").on("click", function () {
    admid = null;
    var modal = document.getElementById("modalError");
    modal.style.display = "none";
    //enable pointer events on the id="main" element
    document.getElementById("main").style.pointerEvents = "auto";
  });
}

function postAdmin() {
  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/admins/saveAdmin.php",
      data: { name: admName, email: admEmail },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg == "success") {
        window.location.href = "../adminList/adminList.php";
      } else {
        //open modalError with msg
        showModal(msg);
      }
    });
  });
}
