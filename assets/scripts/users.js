$(document).ready(function() {
  var isChecked = $("#flexSwitchCheckDefault").is(":checked");
  $("#flexSwitchCheckDefault").on('change', function() {
    //var isChecked = $(this).is(":checked");
    isChecked = !isChecked;
    var userId = $(this).attr('data-id');
    //window.location.replace('/dashboard/users/state/'+userId);
    $.ajax({
      url: '/dashboard/users/state',
      type: 'POST',
      data: { is_active: isChecked, userId: userId },
      success: function(response) {
        Swal.fire({
         // title: "The Internet?",
          text: response.message,
          icon: "success"
        });
        if (isChecked) {
          $("#flexSwitchCheckDefault").prop('checked', true);
          $("#span").removeClass('bg-label-danger').addClass('bg-label-success').text('Active');
        } else {
          $("#flexSwitchCheckDefault").prop('checked', false);
          $("#span").removeClass('bg-label-success').addClass('bg-label-danger').text('Blocked');
        }

      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX error:", textStatus, errorThrown);
      }
    });
  });
});