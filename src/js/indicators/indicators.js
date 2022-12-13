function saveValueByAdmin(indicator, id, table) {
  postValue(indicator, $("#" + indicator + "-admin").val(), id, table);
}

function saveValueByContact(indicator, id, table) {
  postValue(indicator, $("#" + indicator).val(), id, table);
}

function saveComment(indicator, id, table) {
  postValue(indicator, $("#" + indicator + "-comment").val(), id, table);
}

function postValue(indicator, value, id, table) {
  let request = $.ajax({
    method: "POST",
    url: "../../ajaxQuerys/indicators/saveValue.php",
    data: { indicator: indicator, value: value, id: id, table: table },
    dataType: "text",
    type: "post",
    contentType: "application/x-www-form-urlencoded",
  });
}
