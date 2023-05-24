$(document).ready(function() {
  $('#subscribe_button').click(function(e) {
    $('#subscribe_button').prop('disabled', true); // Disable the button during the AJAX request

    // Use AJAX to fetch the login status from a PHP script
    $.ajax({
      url: 'scripts/login_status.php',
      method: 'GET',
      success: function(response) {
        var isLoggedIn = response.isLoggedIn;
        var userID = response.userID;

        if (isLoggedIn) {
          // Retrieve the query from the URL parameter or parse it from the URL
          var urlParams = new URLSearchParams(window.location.search);
          var query = urlParams.get('q');

          if (!query) {
            var url = window.location.href;
            var parts = url.split('/');
            query = parts[parts.length - 1].replace('Beta_', '');
          }

          // Determine the appropriate PHP script based on the subscription status
          var ajaxURL = '';
          var buttonText = '';

          if ($('#subscribe_button').text() === 'SUBSCRIBE') {
            // User is not subscribed, call the query_subscribe.php function
            ajaxURL = 'scripts/query_subscribe.php';
            buttonText = 'UNSUBSCRIBE';
          } else {
            // User is subscribed, call the query_unsubscribe.php function
            ajaxURL = 'scripts/query_unsubscribe.php';
            buttonText = 'SUBSCRIBE';
          }

          // Send the query subscription/unsubscription request to the PHP script
          $.ajax({
            url: ajaxURL,
            method: 'POST',
            data: {
              query: query,
              userID: userID
            },
            success: function(response) {
			  console.log(response); // Handle the success response
			  $('#response_text').text(response); // Set the response as the text content
			  
			  var displayValue = 'inline-block'; // Set the desired display value dynamically, e.g., 'inline', 'inline-block', 'none', etc.
			  $('#response_text').css('display', displayValue); // Set the display property to the desired value

			  // Set the positioning settings
			  var element = document.getElementById('response_text');
			  element.style.position = 'absolute'; // Set the positioning to 'absolute'
			  element.style.left = '140px'; // Set the left position
			  
			  $('#subscribe_button').text(buttonText); // Set the button text
			  $('#subscribe_button').prop('disabled', false); // Enable the button
			},
            error: function() {
              console.log('Error performing subscription/unsubscription.');
              $('#subscribe_button').prop('disabled', false); // Enable the button in case of an error
            }
          });
        }
      },
      error: function() {
        console.log('Error fetching login status.');
        $('#subscribe_button').prop('disabled', false); // Enable the button in case of an error
      }
    });
  });
});
