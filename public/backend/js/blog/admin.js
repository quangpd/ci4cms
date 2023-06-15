$(function () {
  var table = $("#table").tablesortable();
  table.init();

  $(document).on("click", ".btn-modal", function (e) {
    e.preventDefault();

    var url = $(this).attr("href");
    var title = $(this).attr("title");
    $("#dialog .modal-title").html(title);

    $.post(url, function (response) {
      if (response.success == 1) {
        $("#dialog .modal-body").html(response.html);
        $("#dialog").modal("show");
      } else {
        alert(response.message);
      }
    });

    return;
  });
});
