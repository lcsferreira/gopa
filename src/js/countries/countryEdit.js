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
    //get id from url
    let url = window.location.href;
    let id = url.substring(url.lastIndexOf("=") + 1);

    let name = $("#name").val();
    let capital = $("#capital").val();
    let region = $("#region").val();
    let need_translation = $("input[name=need-translation]:checked").val();
    let translation_step;

    if ($("input[name=need-translation]:checked").val() === "1") {
      translation_step = "not started";
    } else {
      translation_step = null;
    }

    let payload = {
      id: id,
      name: name,
      capital: capital,
      region: region,
      need_translation: need_translation,
      translation_step: translation_step,
    };

    console.log(payload);

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
        window.location.href = "../countriesList/countriesListAdmin.php";
      } else {
        alert("country update failed");
      }
    });
  });
}
