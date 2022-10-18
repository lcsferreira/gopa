$(document).ready(function () {
  $("#email-error").hide();
  $("#second-email-error").hide();
  postContact();
  // validateInputs();
  addCountry();
  deleteInputCountry();
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

function deleteInputCountry() {
  $(".inputs").on("click", ".delete", function (e) {
    e.preventDefault();
    $(this).parent("div").remove();
  });
}

function addCountry() {
  $(".add-btn").click(function () {
    $(".inputs").append(
      `<div class="form-input country-input">
        <label for="country">Country</label>
        <input type="text" id="country" class="form" placeholder="Country">
        <div class="form-checkbox">
          <label for="contact-type">Main contact</label>
          <input type="checkbox" id="contact-type" class="form">
        </div>
        <a href="#" class="delete">Delete</a></div>
      </div>`
    );
  });
}

function postContact() {
  $("#saveContact").on("click", function () {
    //foreach country relation get the values
    let name = $("#name").val();
    let email = $("#email").val();
    let secondaryEmail = $("#secondaryEmail").val();
    let institution = $("#institution").val();
    let countries = [];

    $(".country-input").each(function () {
      countries.push({
        country: $(this).find("input[id=country]").val(),
        mainContact: $(this).find("input[id=contact-type]").is(":checked"),
      });
    });

    let payload = {
      name: name,
      email: email,
      secondaryEmail: secondaryEmail,
      institution: institution,
      countries: countries,
    };

    console.log(payload);
  });
}
