jQuery.datetimepicker.setLocale('lv');
jQuery('#datetimepicker').datetimepicker({
  timepicker: false,
  format:'d.m.Y'
});
jQuery('#datetimepicker1').datetimepicker({
  datepicker: false,
  format:'H:i',
  allowTimes: ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00']
});
console.log(jQuery('#datetimepicker1').datetimepicker);
