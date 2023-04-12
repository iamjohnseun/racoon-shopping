$("#addItem").on("submit", function (e) {
  e.preventDefault();
  let item = $("#item").val();
  if (item) {
    $.post(`${basename}/controller`, { action: "doAddItem", email, item }).done(
      function (data) {
        if (data.status === "OK") {
          window.location.reload();
        } else {
          Swal.fire({
            title: "Error!",
            text: data.error,
            icon: "error",
          });
        }
      }
    );
  } else {
    Swal.fire({
      title: "Not Item!",
      text: "Please enter an item to add to your shopping list.",
      icon: "error",
    });
  }
});

$("input[type=checkbox]").on("change", function (e) {
  let status = 0;
  let id = $(this).attr("data-id");
  if ($(this).is(":checked")) {
    status = 1;
  } else {
    status = 0;
  }
  $.post(`${basename}/controller`, { action: "updateItem", email, id, status }).done(
    function (data) {
      if (data.status !== "OK") {
        Swal.fire({
          title: "Error!",
          text: data.error,
          icon: "error",
        });
      }
    }
  );
})

$(".item").on("dblclick", function () {
  let id = $(this).attr("data-id");
  $.post(`${basename}/controller`, { action: "deleteItem", email, id }).done(
    function (data) {
      if (data.status === "OK") {
        window.location.reload();
      } else {
        Swal.fire({
          title: "Error!",
          text: data.error,
          icon: "error",
        });
      }
    }
  );
});
