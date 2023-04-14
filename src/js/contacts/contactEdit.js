$(document).ready(function () {
  $("#email-error").hide();
  $("#second-email-error").hide();
  putContact();
  validateInputs();
  validateEmail();
  validateEmailSecond();
  preventEqualEmails();
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

function validateEmail() {
  $("#email").on("keyup", function () {
    let email = $("#email").val();
    if (email.includes("@")) {
      $("#email-error").hide();
      $("#saveContact").removeAttr("disabled");
      $("#email").removeClass("is-invalid");
    } else {
      $("#email-error").show();
      $("#saveContact").attr("disabled", "disabled");
      $("#email").addClass("is-invalid");
    }
  });
}

function validateEmailSecond() {
  $("#second-email").on("keyup", function () {
    let email = $("#second-email").val();
    if (email.includes("@")) {
      $("#second-email-error").hide();
      $("#saveContact").removeAttr("disabled");
      $("#second-email").removeClass("is-invalid");
    } else {
      $("#second-email-error").show();
      $("#saveContact").attr("disabled", "disabled");
      $("#second-email").addClass("is-invalid");
    }
  });
}

function preventEqualEmails() {
  $("#second-email").on("blur", function () {
    let email = $("#email").val();
    let secondaryEmail = $("#second-email").val();
    if (email === secondaryEmail) {
      $("#email-error").show();
      $("#second-email-error").show();
      $("#saveContact").attr("disabled", "disabled");
    } else {
      $("#email-error").hide();
      $("#second-email-error").hide();
      $("#saveContact").removeAttr("disabled");
    }
  });
}

function deleteInputCountry() {
  $(".inputs").on("click", ".delete", function (e) {
    e.preventDefault();
    //get the value of the select input
    let countryId = $(this).parent().find("#country").val();
    //get the id of the contact
    let url = window.location.href;
    let urlArray = url.split("=");
    let contactId = urlArray[1];

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/contacts/contactCountryDelete.php",
      data: { country_id: countryId, contact_id: contactId },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });
    request.done(function (msg) {
      if (msg == "success") {
        //remove the input
        $(".delete").parent().remove();
      } else if ("no relation found") {
        $(".delete").parent().remove();
      } else {
        alert("Removing relation failed");
      }
    });
  });
}

function addCountry() {
  $(".add-btn").click(function () {
    //add the countryInput.php external file
    $.get("../../components/countryInput.php", function (data) {
      $(".inputs").append(data);
    });
  });
}

function putContact() {
  $("#saveContact").on("click", function () {
    //foreach country relation get the values
    let name = $("#name").val();
    let email = $("#email").val();
    let secondaryEmail = $("#second-email").val();
    let institution = $("#institution").val();
    let isActivated = $("#is-active").is(":checked");

    let is_active = 0;
    if (isActivated) {
      is_active = 1;
    }

    let countries = [];

    $(".country-input").each(function () {
      countries.push({
        country_id: $(this).find("#country").val(),
        is_main: +$(this).find("input[id=contact-type]").is(":checked"),
      });
    });

    if (secondaryEmail === undefined) {
      secondaryEmail = null;
    }

    let id;
    //get id from url
    let url = window.location.href;
    let urlArray = url.split("=");
    id = urlArray[1];

    let payload = {
      id: id,
      name: name,
      email: email,
      secondaryEmail: secondaryEmail,
      institution: institution,
      isActive: is_active,
      countries: countries,
    };

    console.log(payload);

    //check if there are no duplicated email addresses
    let request = $.ajax({
      url: "../../ajaxQuerys/contacts/saveContactEdited.php",
      type: "POST",
      data: { payload: payload },
      dataType: "text",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg.substring(0, 7) == "success") {
        window.location.href = "../contactList/contactList.php";
      } else {
        console.log(msg);
      }
    });
  });
}
