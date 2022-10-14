$(document).ready(function () {
  validateInputs();
  postCountry();
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

function postCountry() {
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
      indicators_step: "not started",
      translation_step: translation_step,
      country_cards_step: "not started",
    };

    console.log(payload);

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/countries/saveCountry.php",
      data: { payload: payload },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg == "success") {
        window.location.href = "../countriesList/countriesListAdmin.php";
      } else {
        alert("Country Registration failed");
      }
    });
  });
}
