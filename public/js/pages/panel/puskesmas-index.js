const table = $("#table-data").DataTable({
  processing: true,
  ajax: {
    url: origin + "/api/puskesmas",
    dataSrc: "",
  },
  columns: [
    { data: "id", title: "ID" },
    { data: "nama", title: "Nama Puskesmas" },
    { data: "alamat", title: "Alamat" },
    {
      data: "id",
      title: "aksi",
      render: function (data) {
        return `<a href="${origin}/puskesmas/edit/${data}" class="btn app-btn-primary"><i class="fas fa-edit"></i></a><a href="${origin}/api/puskesmas/${data}" class="btn app-btn-secondary btn-delete"><i class="fas fa-trash"></i></a>`;
      },
    },
  ],
});

$("body").on("click", ".btn-delete", function (e) {
  e.preventDefault();
  Swal.fire({
    title: "Apakah anda yakin ingin menghapus ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "DELETE",
        url: origin + $(this).attr("href"),
        success: function (res) {
          table.ajax.reload();
          Toast.fire({
            icon: "success",
            title: "Data berhasila di hapus",
          });
        },
      });
    }
  });
});

$(document).ready(function () {
  cloud
    .add(origin + "/api/puskesmas", {
      name: "puskesmas",
    })
    .then((puskesmas) => {});
  cloud.addCallback("puskesmas", function (data) {});
});
