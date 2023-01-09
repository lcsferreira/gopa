//take the modalInfoText.json file and put it in a variable
//when document is ready

let agreementInputs = {
  demographic: [
    "country",
    "capital",
    "total-population",
    "urban-population",
    "life-expentacy",
    "gini-index",
    "human-index",
    "literacy-rate",
    "deaths-diseases",
  ],
  paPrevalence: ["pa-prevalence"],
  inequalitiesParticipation: ["pa-activity", "inequalities-image"],
  nationalSurveillance: [
    "national-surveys",
    "most-recent-year",
    "next-year",
    "survey-names",
    "objective-measures",
    "quantifiable-targets",
  ],
  nationalPolicy: [
    "national-policy",
    "national-recommendations",
    "policy-implementation",
  ],
  research: ["contribution", "pa-quintiles", "gender-inequalities"],
  paPyramid: ["research", "policy", "surveillance", "pyramid-image"],
  contact: [
    "name-1",
    "email-1",
    "institution-1",
    "name-2",
    "email-2",
    "institution-2",
    "name-3",
    "email-3",
    "institution-3",
  ],
};

//get the url and split it before the last /
let url = window.location.href;
let urlSplit = url.split("/");
let page = urlSplit[urlSplit.length - 1];
//split the page name before the ?
let pageSplit = page.split(".");
let table = pageSplit[0];

$(document).ready(function () {
  hideAllDifferentInputOption();
  closeModalInfo();
  closeModalDisplay();
  checkValues();
  checkEmbbedAndStandaloneInputsAdmin();
  checkEmbbedAndStandaloneInputs();
  checkEmbbedAndStandaloneInputsOnBlurAdmin();
  checkEmbbedAndStandaloneInputsOnBlur();
});

function checkValues() {
  agreementInputs[table].forEach(function (input, index) {
    index++;
    if ($("input[name=agreement-" + index + "]:checked").val() == "no-edit") {
      $("#" + input + "-indicator").css("display", "flex");
      if (table == "nationalPolicy") {
        showDifferentInputOption(index);
      }
    } else if (
      $("input[name=agreement-" + index + "]:checked").val() == "yes" ||
      $("input[name=agreement-" + index + "]:checked").val() == undefined ||
      $("input[name=agreement-" + index + "]:checked").val() == "no"
    ) {
      $("#" + input + "-indicator").css("display", "none");
    }
  });
}

function hideAllDifferentInputOption() {
  agreementInputs[table].forEach(function (input, index) {
    index++;
    hideDifferentInputOption(index);
  });
}

window.onunload = function () {
  closeModalInfo();
};

function checkEmbbedAndStandaloneInputsOnBlurAdmin() {
  $("input[name=national-policy-admin]").on("click", function () {
    checkEmbbedAndStandaloneInputsAdmin();
  });
}

function checkEmbbedAndStandaloneInputsOnBlur() {
  $("input[name=national-policy]").on("click", function () {
    checkEmbbedAndStandaloneInputs();
  });
}

function checkEmbbedAndStandaloneInputsAdmin() {
  if ($("input[name=national-policy-admin]:checked").val() == "yes") {
    $("#embbed-prevention-field-admin").css("display", "flex");
    $("#standalone-prevention-field-admin").css("display", "flex");
  } else {
    $("#embbed-prevention-field-admin").css("display", "none");
    $("#standalone-prevention-field-admin").css("display", "none");
  }
}

function checkEmbbedAndStandaloneInputs() {
  if ($("input[name=national-policy]:checked").val() == "yes") {
    $("#embbed-prevention-field").css("display", "flex");
    $("#standalone-prevention-field").css("display", "flex");
  } else {
    $("#embbed-prevention-field").css("display", "none");
    $("#standalone-prevention-field").css("display", "none");
  }
}

function showDifferentInputOption(input) {
  $("#different-value-source-" + input).css("display", "flex");
}

function hideDifferentInputOption(input) {
  $("#different-value-source-" + input).css("display", "none");
}

function saveValueByAdmin(indicator, id, table) {
  postValue(indicator, $("#" + indicator + "-admin").val(), id, table);
}

function saveValueByContact(indicator, id, table) {
  postValue(indicator, $("input[name=" + indicator + "]").val(), id, table);
}

function saveComment(indicator, id, table) {
  postValue(indicator, $("#" + indicator + "-comments").val(), id, table);
}

function postValue(indicator, value, id, table) {
  //replace the - by _ to match the database
  indicator = indicator.replaceAll("-", "_");

  let request = $.ajax({
    method: "POST",
    url: "../../ajaxQuerys/indicators/saveValue.php",
    data: { indicator: indicator, value: value, id: id, table: table },
    dataType: "text",
    type: "post",
    contentType: "application/x-www-form-urlencoded",
  });
}

function saveRadioValue(indicator, id, table) {
  let value = $("input[name=" + indicator + "]:checked").val();
  if (value == "yes") {
    value = "1";
  } else {
    value = "0";
  }
  //remove the -admin from the indicator
  if (indicator.includes("-admin")) {
    indicator = indicator.replace("-admin", "");
  }
  indicator = indicator.replaceAll("-", "_");
  postValue(indicator, value, id, table);
}

function saveRadioValue2(indicator, id, table) {
  let value = $("input[name=" + indicator + "]:checked").val();
  //remove the -admin from the indicator
  if (indicator.includes("-admin")) {
    indicator = indicator.replace("-admin", "");
  }
  indicator = indicator.replaceAll("-", "_");
  postValue(indicator, value, id, table);
}

function showInput(agreement, input, id, table) {
  input = input.replaceAll("_", "-");
  if ($("input[name=" + agreement + "]:checked").val() == "no-edit") {
    $("#" + input + "-indicator").css("display", "flex");
    postValue(input, 2, id, table + "_agreement");
  }
}

function hideInput(agreement, input, id, table) {
  input = input.replaceAll("_", "-");
  if ($("input[name=" + agreement + "]:checked").val() == "yes") {
    $("#" + input + "-indicator").css("display", "none");
    postValue(input, 1, id, table + "_agreement");
  } else if ($("input[name=" + agreement + "]:checked").val() == "no") {
    $("#" + input + "-indicator").css("display", "none");
    postValue(input, 0, id, table + "_agreement");
  }
}

function showModalInfo(indicator) {
  let modal = document.getElementById("modalInfo");
  modal.style.display = "block";
  //disable pointer events on the id="main" element except for the modal
  document.getElementById("main").style.pointerEvents = "none";
  //disable scroll on the html element
  document.body.style.overflow = "hidden";
  //enable pointer events on the modal
  document.getElementById("modalInfo").style.pointerEvents = "auto";
  //set the text of the modal
  $.getJSON("../../js/indicators/modalInfoText.json", function (data) {
    let modalInfoText = data;
    document.getElementById("modalInfoText").innerHTML =
      modalInfoText[indicator].body;
  }).fail(function () {
    console.log("An error has occurred.");
  });
}

function closeModalInfo() {
  $("#closeModalInfo").on("click", function () {
    let modal = document.getElementById("modalInfo");
    modal.style.display = "none";
    document.body.style.overflow = "auto";
    //enable pointer events on the id="main" element
    document.getElementById("main").style.pointerEvents = "auto";
  });
}

function showModalDisplay() {
  let modal = document.getElementById("modalDisplay");
  modal.style.display = "block";
  //disable pointer events on the id="main" element except for the modal
  document.getElementById("main").style.pointerEvents = "none";
  //disable scroll on the html element
  document.body.style.overflow = "hidden";
  //enable pointer events on the modal
  document.getElementById("modalDisplay").style.pointerEvents = "auto";
}

function closeModalDisplay() {
  $("#closeModalDisplay").on("click", function () {
    let modal = document.getElementById("modalDisplay");
    modal.style.display = "none";
    document.body.style.overflow = "auto";
    //enable pointer events on the id="main" element
    document.getElementById("main").style.pointerEvents = "auto";
  });
}
