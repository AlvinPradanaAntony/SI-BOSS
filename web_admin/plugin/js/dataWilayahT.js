var return_first = (function () {
  var tmp = null;
  $.ajax({
    async: false,
    type: "get",
    global: false,
    dataType: "json",
    url: "https://x.rajaapi.com/poe",
    success: function (data) {
      tmp = data.token;
    },
  });
  return tmp;
})();
$(document).ready(function () {
  $.ajax({
    url: "https://x.rajaapi.com/MeP7c5ne" + window.return_first + "/m/wilayah/provinsi",
    type: "GET",
    dataType: "json",
    success: function (json) {
      if (json.code == 200) {
        for (i = 0; i < Object.keys(json.data).length; i++) {
          $("#propinsi").append($("<option>").text(json.data[i].name).attr("value", json.data[i].id));
        }
      } else {
        $("#kabupaten").append($("<option>").text("Data tidak di temukan").attr("value", "Data tidak di temukan"));
      }
    },
  });
  $("#propinsi").change(function () {
    var propinsi = $("#propinsi").val();
    $.ajax({
      url: "https://x.rajaapi.com/MeP7c5ne" + window.return_first + "/m/wilayah/kabupaten",
      data: "idpropinsi=" + propinsi,
      type: "GET",
      cache: false,
      dataType: "json",
      success: function (json) {
        $("#kabupaten").html("");
        if (json.code == 200) {
          for (i = 0; i < Object.keys(json.data).length; i++) {
            $("#kabupaten").append($("<option>").text(json.data[i].name).attr("value", json.data[i].id));
          }
          $("#kecamatan").html($("<option>").text("-- Pilih Kecamatan --").attr("value", "-- Pilih Kecamatan --"));
          $("#kelurahan").html($("<option>").text("-- Pilih Kelurahan --").attr("value", "-- Pilih Kelurahan --"));
        } else {
          $("#kabupaten").append($("<option>").text("Data tidak di temukan").attr("value", "Data tidak di temukan"));
        }
      },
    });
  });
  $("#kabupaten").change(function () {
    var kabupaten = $("#kabupaten").val();
    $.ajax({
      url: "https://x.rajaapi.com/MeP7c5ne" + window.return_first + "/m/wilayah/kecamatan",
      data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
      type: "GET",
      cache: false,
      dataType: "json",
      success: function (json) {
        $("#kecamatan").html("");
        if (json.code == 200) {
          for (i = 0; i < Object.keys(json.data).length; i++) {
            $("#kecamatan").append($("<option>").text(json.data[i].name).attr("value", json.data[i].id));
          }
          $("#kelurahan").html($("<option>").text("-- Pilih Kelurahan --").attr("value", "-- Pilih Kelurahan --"));
        } else {
          $("#kecamatan").append($("<option>").text("Data tidak di temukan").attr("value", "Data tidak di temukan"));
        }
      },
    });
  });
  $("#kecamatan").change(function () {
    var kecamatan = $("#kecamatan").val();
    $.ajax({
      url: "https://x.rajaapi.com/MeP7c5ne" + window.return_first + "/m/wilayah/kelurahan",
      data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
      type: "GET",
      dataType: "json",
      cache: false,
      success: function (json) {
        $("#kelurahan").html("");
        if (json.code == 200) {
          for (i = 0; i < Object.keys(json.data).length; i++) {
            $("#kelurahan").append($("<option>").text(json.data[i].name).attr("value", json.data[i].id));
          }
        } else {
          $("#kelurahan").append($("<option>").text("Data tidak di temukan").attr("value", "Data tidak di temukan"));
        }
      },
    });
  });
});
