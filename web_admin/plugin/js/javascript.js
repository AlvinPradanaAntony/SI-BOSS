// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();
  var checebox = $('table tbody input[type=checkbox]');

  $(".selectAll").click(function () 
  {
    if (this.checked) 
    {
      checebox.each(function () 
      {
        this.checked = true;
      });
    } else {
      checebox.each(function () {
        this.checked = false;
      });
    }
  });
  checkbox.click(function () 
  {
    if (this.checked) 
    {
      $("selectAll").prop("checked", false);
    }
  });
})
