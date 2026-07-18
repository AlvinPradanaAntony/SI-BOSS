document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (element) {
    bootstrap.Tooltip.getOrCreateInstance(element);
  });

  document.querySelectorAll(".selectAll").forEach(function (selectAll) {
    var table = selectAll.closest("table");
    if (!table) {
      return;
    }

    var checkboxes = table.querySelectorAll("tbody input[type=checkbox]");

    selectAll.addEventListener("change", function () {
      checkboxes.forEach(function (checkbox) {
        checkbox.checked = selectAll.checked;
      });
    });

    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener("change", function () {
        if (!checkbox.checked) {
          selectAll.checked = false;
        }
      });
    });
  });
});
