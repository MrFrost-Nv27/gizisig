$(document).ready(function () {
  cloud
    .add(origin + "/api/puskesmas", {
      name: "puskesmas",
      callback: (data) => {
        elPuskesmas.text(puskesmas.length).counterUp();
      },
    })
    .then((puskesmas) => {
      $(".perpuskesmas-wrapper").empty();
      puskesmas.forEach((d) => {
        const el = `
      <div class="col-12 col-lg-4">
          <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
              <div class="app-card-header p-3 border-bottom-0">
                  <div class="row align-items-center gx-3">
                      <div class="col-auto">
                          <div class="app-icon-holder">
                              <i class="fa-regular fa-hospital"></i>
                          </div>
                      </div>
                      <div class="col-auto">
                          <h4 class="app-card-title">${d.nama}</h4>
                      </div>
                  </div>
              </div>
              <div class="app-card-body px-4">
                  <div class="intro">Total Pasien Penderita Gizi: <span id="count-${d.id}">0</span></div>
              </div>
              <div class="app-card-footer p-4 mt-auto">
              </div>
          </div>
      </div>
    `;
        $(".perpuskesmas-wrapper").append(el);
      });
      cloud
        .add(origin + "/api/pasien", {
          name: "pasien",
          callback: (data) => {
            elPasien.text(pasien.length).counterUp();
          },
        })
        .then((pasien) => {
          puskesmas.forEach((d) => {
            $(`#count-${d.id}`).text(pasien.filter((p) => p.id_puskesmas == d.id).length).counterUp();
          });
        });
    });
});
