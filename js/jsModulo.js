$(function() {
  var queryDate = '2009-11-01',
    dateParts = queryDate.match(/(\d+)/g)
  realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
  $('#inizioPeriodo').datepicker({
      dateFormat: "MM yy"
    }) // format to show
    .datepicker('setDate', realDate)
    .datepicker("option", "changeMonth", true)
    .datepicker("option", "changeYear", true)
    .datepicker("option", "showButtonPanel", true)
    .datepicker("option", "onClose", function(e) {
      var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
      $(this).datepicker("setDate", new Date(year, month, 1));
    }),
    $('#finePeriodo').datepicker({
      dateFormat: "MM yy"
    }) // format to show
    .datepicker('setDate', realDate)
    .datepicker("option", "changeMonth", true)
    .datepicker("option", "changeYear", true)
    .datepicker("option", "showButtonPanel", true)
    .datepicker("option", "onClose", function(e) {
      var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
      $(this).datepicker("setDate", new Date(year, month, 1));
    });
});
