//take the modalInfoText.json file and put it in a variable
//when document is ready
$(document).ready(function () {
  $("#country-indicator").css("display", "none");
  $("#capital-indicator").css("display", "none");
  $("#total-population-indicator").css("display", "none");
  $("#urban-population-indicator").css("display", "none");
  $("#life-expentacy-indicator").css("display", "none");
  closeModalInfo();
});

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

function showInput(agreement, input) {
  if ($("input[name=" + agreement + "]:checked").val() == "no") {
    $("#" + input + "-indicator").css("display", "flex");
  }
}

function hideInput(agreement, input) {
  if ($("input[name=" + agreement + "]:checked").val() == "yes") {
    $("#" + input + "-indicator").css("display", "none");
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
