$(document).ready(function() {
    $("#delete-service").on('click', function(e) {
      e.preventDefault();
  
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to remove this service!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var serviceId = $(this).attr("service-id");
  
          $.ajax({
            url: '/dashboard/services/delete',
            type: 'POST',
            data: { id: serviceId },
            success: function(response) {
              Swal.fire({
                text: response.message,
                icon: "success"
              }).then(() => {
                window.location.reload();
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.error("AJAX error:", textStatus, errorThrown);
              Swal.fire({
                title: 'Error!',
                text: 'Failed to delete service.',
                icon: 'error'
              });
            }
          });
        }
      });
    });

    //archive

    $("#archive-service").on('click', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to "+$(this).attr("action-text")+" this service!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, '+$(this).attr("action-text")+' it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var serviceId = $(this).attr("service-id");
    
            $.ajax({
              url: '/dashboard/services/archive',
              type: 'POST',
              data: { id: serviceId },
              success: function(response) {
                Swal.fire({
                  text: response.message,
                  icon: "success"
                }).then(() => {
                  window.location.reload();
                });
              },
              error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
                Swal.fire({
                  title: 'Error!',
                  text: 'Failed try again.',
                  icon: 'error'
                });
              }
            });
          }
        });
      });
  });