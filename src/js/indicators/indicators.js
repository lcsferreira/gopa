//when document is ready
$(document).ready(function () {
  //display none to country-input
  $("#country-indicator").css("display", "none");
});

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
  if ($("input[name=" + agreement + "]:checked").val() == "yes") {
    $("#" + input + "-indicator").css("display", "flex");
  }
}

function hideInput(agreement, input) {
  if ($("input[name=" + agreement + "]:checked").val() == "no") {
    $("#" + input + "-indicator").css("display", "none");
  }
}
