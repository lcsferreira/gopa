$(document).ready(function () {
  validateInputs();
  putCountry();
});

function validateInputs() {
  $(".forms").keyup(function () {
    $('input[type="text"]').each(function () {
      if ($(this).val() === "") {
        $("#saveCountry").attr("disabled", "disabled");
        return false;
      } else {
        $("#saveCountry").removeAttr("disabled");
      }
    });
  });
}

function putCountry() {
  $("#saveCountry").on("click", function () {
    let name = $("#name").val();
    let capital = $("#capital").val();
    let region = $("#region").val();
    let need_translation;
    let translation_step = "not started";
    if ($("input[name=need-translation]:checked").val() === "yes") {
      need_translation = 1;
    } else {
      need_translation = 0;
      translation_step = null;
    }

    let payload = {
      name: name,
      capital: capital,
      region: region,
      need_translation: need_translation,
      translation_step: translation_step,
    };

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/countries/saveCountryEdited.php",
      data: { payload: payload },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg.substring(0, 7) == "success") {
        window.location.href = "../adminList/adminList.php";
      } else {
        alert("country update failed");
      }
    });
  });
}
