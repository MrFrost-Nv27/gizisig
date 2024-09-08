const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  },
});

const capEachWord = (a) => {
  if (a) {
    return a
      .toLowerCase()
      .split(" ")
      .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
      .join(" ");
  }
  return "";
};

$.ajaxSetup({
  error: function (xhr, status, error) {
    let messages = JSON.parse(xhr.responseText).messages;
    if (typeof messages == "object") {
      messages = Object.values(messages);
    }
    console.log(messages);
    Toast.fire({
      icon: "error",
      title: messages
    });
  },
});

$(".datatable-init").DataTable();

$(document).ready(function () {
  $(`[data-pagenav=${page}]`).addClass("active");
  if ($(`[data-pagenav=${page}]`).hasClass("submenu-link")) {
    $(`[data-pagenav=${page}]`).closest(".collapse").addClass("show");
    $(`[data-pagenav=${page}]`).closest(".submenu-toggle").removeClass("collapsed");
  }
});