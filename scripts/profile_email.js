$(document).ready(function() {
    // Use AJAX to fetch the login status from a PHP script
    $.ajax({
        url: 'scripts/login_status.php',
        method: 'GET',
        success: function(response) {
            var isLoggedIn = response.isLoggedIn;
            var userID = response.userID;
            
            if (isLoggedIn) {
                // User is logged in, fetch the query names
                $.ajax({
                    url: 'scripts/fetch_email.php',
                    method: 'GET',
                    data: { userID: userID },
                    success: function(emailResponse) {
                        var account_email = document.getElementById('account-email');
						account_email.textContent = emailResponse.email;
                    },
                    error: function() {
                        console.log('Error fetching email.');
                    }
                });
            }
        },
        error: function() {
            console.log('Error fetching login status.');
        }
    });
});
