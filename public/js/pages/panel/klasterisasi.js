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
let markerColor = [
  "red",
  "orange",
  "gold",
  "yellow",
  "violet",
  "blue",
  "green",
  "red",
  "orange",
  "gold",
  "yellow",
  "violet",
  "blue",
  "green",
  "red",
  "orange",
  "gold",
  "yellow",
  "violet",
  "blue",
  "green",
  "red",
  "orange",
  "gold",
  "yellow",
  "violet",
  "blue",
  "green",
];

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
  const data = {};
  $(this)
    .serializeArray()
    .map(function (x) {
      data[x.name] = Number(x.value);
    });

  $("#table-jarak tbody td").removeClass("bg-success").removeClass("text-white");

  const ptsCount = {};

  $.each($("#table-jarak tbody td"), function (i, td) {
    const tdId = $(td).attr("id").split("-")[0];
    if (Number($(td).text()) != 0 && Number($(td).text()) <= data.epsilon) {
      $(td).addClass("bg-success").addClass("text-white");
      if (!ptsCount[tdId]) ptsCount[tdId] = 0;
      ptsCount[tdId]++;
    }
  });

  $("#table-pts tbody td").removeClass("bg-success").removeClass("text-white");
  $("#table-pts tbody td").text(0);

  $.each(ptsCount, function (k, v) {
    $("#table-pts tbody td#pts-" + k).text(v);
    if (v >= data.minpts) {
      $("#table-pts tbody td#pts-" + k)
        .addClass("bg-success")
        .addClass("text-white");
    }
  });

  $.ajax({
    type: "POST",
    url: origin + "/api/dbscan",
    data: data,
    success: function (res) {
      $(markerPasien).each((index) => markerPasien[index].setIcon(generateIcon("grey")));
      console.log(res);
      $("#silhoutte-score").text(0);
      let outliers = cloud.get("pasien");
      res.data.forEach((dtt) => (outliers = outliers.filter((o) => !dtt.includes(o.id - 1))));
      console.log(outliers);

      if (res.data.length > 0) {
        $("#no-klaster").fadeOut("normal", () => {
          $("#table-hasil-klaster").fadeIn();
          let howMuch = 0;
          $(res.data).each((i, v) => (v.length > howMuch ? (howMuch = v.length) : null));
          if (outliers.length > howMuch) howMuch = outliers.length;

          $("#table-klaster thead").empty();
          $("#table-klaster tbody").empty();

          for (let much = 1; much <= howMuch; much++) {
            let tdk = "";
            for (let k = 1; k <= res.data.length; k++) {
              tdk += `<td id="k-${much}-${k}-nama"></td>`;
              tdk += `<td id="k-${much}-${k}-usia"></td>`;
              tdk += `<td id="k-${much}-${k}-bb"></td>`;
              tdk += `<td id="k-${much}-${k}-tb"></td>`;
            }
            tdk += `<td id="k-${much}-outlier-nama"></td>`;
            tdk += `<td id="k-${much}-outlier-usia"></td>`;
            tdk += `<td id="k-${much}-outlier-bb"></td>`;
            tdk += `<td id="k-${much}-outlier-tb"></td>`;
            $("#table-klaster tbody").append(`<tr>${tdk}</tr>`);
          }
          let tdc = "";
          let tdh = "";
          for (let k = 1; k <= res.data.length; k++) {
            tdc += `<th colspan="4">Klaster ${k} (${res.data[k - 1].length})</th>`;
            tdh += `
            <th>Nama</th>
            <th>Usia</th>
            <th>BB</th>
            <th>TB</th>
            `;
          }
          tdc += `<th colspan="4">Outlier (${outliers.length})</th>`;
          tdh += `
              <th>Nama</th>
              <th>Usia</th>
              <th>BB</th>
              <th>TB</th>
              `;
          $("#table-klaster thead").append(`<tr>${tdc}</tr><tr>${tdh}</tr>`);
          $("#jml-klaster").text(res.data.length);

          $(res.data).each((i, v) => {
            const dataAll = v.map((vi) => cloud.get("pasien").find((x) => x.id == vi + 1));
            dataAll.sort((a, b) => {
              if (a.usia > b.usia) return 1;
              if (a.usia < b.usia) return -1;

              if (a.bb > b.bb) return 1;
              if (a.bb < b.bb) return -1;

              return a.tb - b.tb;
            });
            $.each(dataAll, (idx, dataView) => {
              $(`#k-${idx + 1}-${i + 1}-nama`).text(dataView.nama);
              $(`#k-${idx + 1}-${i + 1}-usia`).text(dataView.usia);
              $(`#k-${idx + 1}-${i + 1}-bb`).text(dataView.bb);
              $(`#k-${idx + 1}-${i + 1}-tb`).text(dataView.tb);
              markerPasien[idx].setIcon(generateIcon(markerColor[i]));
            });
          });

          outliers.sort((a, b) => {
            if (a.usia > b.usia) return 1;
            if (a.usia < b.usia) return -1;

            if (a.bb > b.bb) return 1;
            if (a.bb < b.bb) return -1;

            return a.tb - b.tb;
          });

          outliers.forEach((o, idx) => {
            $(`#k-${idx + 1}-outlier-nama`).text(o.nama);
            $(`#k-${idx + 1}-outlier-usia`).text(o.usia);
            $(`#k-${idx + 1}-outlier-bb`).text(o.bb);
            $(`#k-${idx + 1}-outlier-tb`).text(o.tb);
          });

          $("#silhoutte-score").text(silhouetteScore(res.data));
        });
        return;
      }
      $("#table-hasil-klaster").fadeOut("normal", () => {
        $("#no-klaster").fadeIn();
      });
    },
  });
});

$(".klasterisasi-nav-link").on("click", function (e) {
  e.preventDefault();
  const target = $($(this).attr("href"));
  const offset = 120; // Minimum margin from the top

  $("html, body").animate({
    scrollTop: target.offset().top - offset,
  }); // Adjust 500ms for the speed of the scroll
});

// Fungsi untuk menghitung jarak Euclidean antara dua titik
function euclideanDistance(point1, point2) {
  return Number($(`#${point1 + 1}-${point2 + 1}`).text());
}

// Fungsi untuk menghitung a(i), rata-rata jarak ke semua titik dalam cluster yang sama
function intraClusterDistance(point, cluster) {
  let totalDistance = 0;
  for (let otherPoint of cluster) {
    totalDistance += euclideanDistance(point, otherPoint);
  }
  return totalDistance / (cluster.length - 1);
}

// Fungsi untuk menghitung b(i), rata-rata jarak ke semua titik di cluster terdekat lainnya
function interClusterDistance(point, clusters, currentCluster) {
  let minAvgDistance = Infinity;
  for (let cluster of clusters) {
    if (cluster !== currentCluster) {
      let totalDistance = 0;
      for (let otherPoint of cluster) {
        totalDistance += euclideanDistance(point, otherPoint);
      }
      let avgDistance = totalDistance / cluster.length;
      if (avgDistance < minAvgDistance) {
        minAvgDistance = avgDistance;
      }
    }
  }
  return minAvgDistance;
}

// Fungsi untuk menghitung silhouette score untuk satu titik
function silhouetteScoreForPoint(point, currentCluster, clusters) {
  const a = intraClusterDistance(point, currentCluster);
  const b = interClusterDistance(point, clusters, currentCluster);
  return (b - a) / Math.max(a, b);
}

// Fungsi untuk menghitung rata-rata silhouette score untuk semua titik
function silhouetteScore(clusters) {
  let totalSilhouette = 0;
  let totalPoints = 0;

  for (let cluster of clusters) {
    for (let point of cluster) {
      totalSilhouette += silhouetteScoreForPoint(point, cluster, clusters);
      totalPoints++;
    }
  }

  return totalSilhouette / totalPoints;
}

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
            $("#table-pts").find("tbody").append(`<tr><td id="pts-${v.id}">0</td></tr>`);
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
