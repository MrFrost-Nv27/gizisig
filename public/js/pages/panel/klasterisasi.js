const supermap = L.map("klastermap").setView([-7.247886, 109.007832], 12);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(supermap);
const hospitalIcon = L.divIcon({
  className: "hospital-icon",
  html: '<i class="fas fa-hospital text-success"></i>',
  iconSize: [100, 100],
  popupAnchor: [0, -16],
});
let markerPasien = [];
let markerPuskesmas = [];
let markerColor = ["red", "orange", "gold", "yellow", "violet", "blue", "green"];

function generateIcon(color = "") {
  return new L.Icon({
    iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${color}.png`,
    shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41],
  });
}

$("body").on("submit", "#form-klaster", function (e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: origin + "/api/dbscan",
    data: $(this).serialize(),
    success: function (res) {
      $(markerPasien).each((index) => markerPasien[index].setIcon(generateIcon("grey")));
      console.log(res);
      $(".hasil-klaster .accordion").empty();
      $(res.data).each((i, v) => {
        const list = $($("#klaster-list")[0].content.cloneNode(true));
        list.find(".accordion-header").attr("id", `flush-h${i + 1}`);
        list.find(".accordion-button").attr("data-bs-target", `#flush-${i + 1}`);
        list.find(".accordion-button").attr("aria-controls", `flush-${i + 1}`);
        list.find(".accordion-button").text(`Klaster #${i + 1}`);
        list.find(".accordion-collapse").attr("id", `flush-${i + 1}`);
        list.find(".accordion-collapse").attr("aria-labelledby", `flush-h${i + 1}`);
        $.each(v, (k, idx) => {
          list.find(".list-group").append(`<a href="#" class="list-group-item list-group-item-action">${cloud.get("pasien").find((x) => x.id == idx+1).nama}</a>`);
          markerPasien[idx].setIcon(generateIcon(markerColor[i]));
        });
        $(".hasil-klaster .accordion").append(list);
      });
    },
  });
});

$(document).ready(function () {
  $("form").off();
  $("#form-klaster").find("[type=submit]").prop("disabled", true);
  cloud
    .add(origin + "/api/puskesmas", {
      name: "puskesmas",
    })
    .then((puskesmas) => {
      $.each(puskesmas, function (i, v) {
        let latlng = L.latLng(parseFloat(v.latitude), parseFloat(v.longitude));
        mark = new L.Marker(latlng, {
          icon: hospitalIcon,
        })
          .addTo(supermap)
          .bindPopup(v.nama);
        mark.bounce();
        markerPuskesmas.push(mark);
      });
      cloud
        .add(origin + "/api/pasien", {
          name: "pasien",
        })
        .then((pasien) => {
          const tableJarak = $("#table-jarak");
          tableJarak.find("thead").empty();
          tableJarak.find("tbody").empty();
          tableJarak.find("tfoot").empty();
          tableJarak.find("thead").append(`
            <tr>
              <th>#</th>
            </tr>
          `);
          $.each(pasien, function (i, v) {
            tableJarak.find("thead tr").append(`
              <th>${v.id}</th>
              `);
            let tds = "";
            for (let j = 0; j < pasien.length; j++) {
              tds += `<td id="${v.id}-${pasien[j].id}"></td>`;
            }
            tableJarak.find("tbody").append(`
              <tr>
                <th>${v.id}</th>
                ${tds}
              </tr>
              `);
            let mark = new L.Marker(L.latLng(parseFloat(v.latitude), parseFloat(v.longitude)), {
              icon: generateIcon("blue"),
            })
              .addTo(supermap)
              .bindPopup(v.nama);
            markerPasien.push(mark);
          });
          cloud
            .add(origin + "/api/distance", {
              name: "distance",
            })
            .then((distance) => {
              $.each(distance, function (j, dist) {
                $.each(dist, function (k, d) {
                  $(`#${j}-${k}`).text(d);
                });
              });
              $("#form-klaster").find("[type=submit]").prop("disabled", false);
            });
        });
    });
});
