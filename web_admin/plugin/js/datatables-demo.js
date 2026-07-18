// =============================================================================
// SI-BOSS — DataTables initializer
// -----------------------------------------------------------------------------
// Layout:
//   • Baris atas   : length select (kiri) + search filter (kanan)
//   • Tabel        : dibungkus .table-responsive dari DataTables
//   • Baris bawah  : info entries (kiri) + pagination (kanan)
// =============================================================================
$(document).ready(function () {
  $(".dataTable").each(function () {
    if ($.fn.dataTable.isDataTable(this)) {
      return;
    }

    $(this).DataTable({
      // Toolbar (length + filter) di atas, table di tengah, info + pagination di bawah.
      // Table dibungkus .table-responsive supaya hanya area tabel yang scroll horizontal
      // (toolbar & pagination tetap fit di viewport).
      dom:
        "<'dt-toolbar'<'dt-toolbar-left'l><'dt-toolbar-right'f>>" +
        "<'table-responsive't>" +
        "r" +
        "<'dataTables_info'i><'dataTables_paginate'p>",

      lengthMenu: [
        [10, 25, 50, 100, -1],
        ["10", "25", "50", "100", "Semua"],
      ],
      pageLength: 10,
      pagingType: "simple_numbers",
      responsive: false,
      autoWidth: false,
      order: [],

      language: {
        lengthMenu: "Tampilkan _MENU_ data",
        search: "",
        searchPlaceholder: "Cari data…",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data",
        infoFiltered: "(disaring dari _MAX_ total data)",
        zeroRecords: "Tidak ditemukan data yang cocok",
        emptyTable: "Belum ada data tersedia",
        paginate: {
          first: '<i class="bx bx-chevrons-left"></i>',
          previous: '<i class="bx bx-chevrons-left"></i>',
          next: '<i class="bx bx-chevrons-right"></i>',
          last: '<i class="bx bx-chevrons-right"></i>',
        },
      },

      // Kolom action & checkbox tidak perlu di-sort.
      columnDefs: [
        { orderable: false, targets: ["cb", "actions", "foto"].map(function (c) { return "." + c; }) },
      ],
      
      initComplete: function () {
        $(this.api().table().node()).addClass("table-initialized").hide().fadeIn(400);
      },
    });
  });
});
