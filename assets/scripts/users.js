$(document).ready(function() {
  $("#flexSwitchCheckDefault").on('change', function() {
    var isChecked = $(this).is(":checked");
    var userId = 1;
    window.location.replace('/dashboard/users/state/'+userId);
  });
});