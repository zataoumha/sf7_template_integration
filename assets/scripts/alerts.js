$(document).ready(function() {
    $("#delete-service").on('click', function(e) {
      e.preventDefault();
      if (confirm("Are you sure you want to delete this service?")) {
        // Add your deletion logic here (e.g., AJAX request)
        alert("Service deleted!"); // Or some other success message
      }
    });
  });