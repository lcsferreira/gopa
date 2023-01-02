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
  closeModalInfo();

  checkValues();
});

function checkValues() {
  agreementInputs[table].forEach(function (input, index) {
    //sum the index ++ at the string;
    index++;
    if ($("input[name=agreement-" + index + "]:checked").val() == "no") {
      // console.log("no" + input + index);
      $("#" + input + "-indicator").css("display", "flex");
    } else if (
      $("input[name=agreement-" + index + "]:checked").val() == "yes" ||
      $("input[name=agreement-" + index + "]:checked").val() == undefined
    ) {
      $("#" + input + "-indicator").css("display", "none");
      // console.log("yes" + input + index);
    }
  });
}

window.onunload = function () {
  closeModalInfo();
};

function saveValueByAdmin(indicator, id, table) {
  postValue(indicator, $("#" + indicator + "-admin").val(), id, table);
}

function saveValueByContact(indicator, id, table) {
  postValue(indicator, $("#" + indicator).val(), id, table);
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
    value = 1;
  } else {
    value = 0;
  }
  indicator = indicator.replaceAll("-", "_");
  //remove the -admin from the indicator
  if (indicator.includes("-admin")) {
    indicator = indicator.replace("-admin", "");
  }
  postValue(indicator, value, id, table);
}

function saveRadioValue2(indicator, id, table) {
  let value = $("input[name=" + indicator + "]:checked").val();
  indicator = indicator.replaceAll("-", "_");
  //remove the -admin from the indicator
  if (indicator.includes("-admin")) {
    indicator = indicator.replace("-admin", "");
  }
  postValue(indicator, value, id, table);
}

function showInput(agreement, input, id, table) {
  if ($("input[name=" + agreement + "]:checked").val() == "no") {
    $("#" + input + "-indicator").css("display", "flex");
    postValue(input, 0, id, table + "_agreement");
  }
}

function hideInput(agreement, input, id, table) {
  if ($("input[name=" + agreement + "]:checked").val() == "yes") {
    $("#" + input + "-indicator").css("display", "none");
    postValue(input, 1, id, table + "_agreement");
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
