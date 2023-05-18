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

					// Send the query subscription request to the PHP script
					$.ajax({
						url: 'scripts/query_subscribe.php',
						method: 'POST',
						data: {
							query: query,
							userID: userID
						},
						success: function(response) {
							console.log(response); // Handle the success response
							$('#response_text').text(response); // Set the response as the text content
                            $('#response_text').show(); // Show the response text
                            $('#subscribe_button').prop('disabled', false); // Enable the button
						},
						error: function() {
							console.log('Error adding subscription.');
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
