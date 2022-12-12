$(document).ready(function () {});

//function to save the value of the input

function saveValueByAdmin(indicator, id) {
  postValue(indicator, $("#" + indicator + "-admin").val(), id, "Admin");
}

function saveValueByContact(indicator, id) {
  console.log(indicator, $("#" + indicator).val(), id);
  postValue(indicator, $("#" + indicator).val(), id, "Contact");
}

function saveComment(indicator, id) {
  postValue(indicator, $("#" + indicator + "-comment").val(), id, "Comment");
}

function postValue(indicator, value, id, type) {
  let request = $.ajax({
    method: "POST",
    url: "../../ajaxQuerys/indicators/saveValue" + type + ".php",
    data: { indicator: indicator, value: value, id: id },
    dataType: "text",
    type: "post",
    contentType: "application/x-www-form-urlencoded",
  });

  request.done(function (msg) {
    console.log(msg);
  });
}

function saveValueByContact() {}
