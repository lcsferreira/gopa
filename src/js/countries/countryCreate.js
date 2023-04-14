$(document).ready(function () {
  validateInputs();
  postCountry();
});

function validateInputs() {
  $(".forms").keyup(function () {
    $('input[type="text"]').each(function () {
      if ($(this).val() === "") {
        $("#saveCountry").attr("disabled", "disabled");
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
    let translation_step;

    if ($("input[name=need-translation]:checked").val() === "yes") {
      translation_step = "not started";
      need_translation = 1;
    } else {
      translation_step = null;
      need_translation = 0;
    }

    let payload = {
      name: name,
      capital: capital,
      region: region,
      need_translation: need_translation,
      indicators_step: "not started",
      translation_step: translation_step,
      country_cards_step_en: "not started",
      country_cards_step: translation_step,
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
