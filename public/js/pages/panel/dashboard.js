const map = L.map("map").setView([-7.247886, 109.007832], 12);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: "&copy; OpenStreetMap contributors",
}).addTo(map);

const hospitalIcon = L.divIcon({
  className: "hospital-icon",
  html: '<i class="fas fa-hospital" style="color: green;"></i>',
  iconSize: [30, 30],
  popupAnchor: [0, -16],
});

const humanIcon = L.divIcon({
  className: "human-icon",
  html: '<i class="fas fa-user" style="color: orange;"></i>',
  iconSize: [30, 30],
  popupAnchor: [0, -16],
});

const puskesmasMarkers = [];
const pasienMarkers = [];

const elPuskesmas = $("#count-puskesmas");
const elPasien = $("#count-pasien");
$(document).ready(function () {
  cloud
    .add(origin + "/api/puskesmas", {
      name: "puskesmas",
      callback: (data) => {
        elPuskesmas.text(puskesmas.length).counterUp();
      },
    })
    .then((puskesmas) => {
      elPuskesmas.text(puskesmas.length).counterUp();
      puskesmas.forEach((d) => {
        const m = L.marker([d.latitude, d.longitude], {
          icon: hospitalIcon,
        }).addTo(map);

        m.on("click", function () {
          const detailContent = `<h4>Informasi Puskesmas</h4>
              <table>
              <tr><td>Nama:</td><td>${d.nama}</td></tr>
              <tr><td>Alamat:</td><td>${d.alamat}</td></tr>
              </table>`;

          $("#detailContent").html(detailContent);
          $("#detailModal").modal("show");
        });
      });
    });
  cloud
    .add(origin + "/api/pasien", {
      name: "pasien",
      callback: (data) => {
        elPasien.text(pasien.length).counterUp();
      },
    })
    .then((pasien) => {
      elPasien.text(pasien.length).counterUp();
      pasien.forEach((d) => {
        const m = L.marker([d.latitude, d.longitude], {
          icon: humanIcon,
        }).addTo(map);

        m.on("click", function () {
          const detailContent = `<h4>Informasi Pasien</h4>
              <table>
              <tr><td>Nama:</td><td>${d.nama}</td></tr>
              <tr><td>Alamat:</td><td>${d.alamat}</td></tr>
              <tr><td>Jenis Kelamin:</td><td>${d.jk == "L" ? "Laki-laki" : "Perempuan"}</td></tr>
              <tr><td>Orang Tua/Wali:</td><td>${d.ortu}</td></tr>
              </table>`;

          $("#detailContent").html(detailContent);
          $("#detailModal").modal("show");
        });
      });
    });
});
