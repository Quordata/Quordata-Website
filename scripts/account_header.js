$(document).ready(function() {
    // Check if the user is on the login page
    var isLoginPage = window.location.pathname.includes('Login_Page');

    if (!isLoginPage) {
        // Use AJAX to fetch the login status from a PHP script
        $.ajax({
            url: 'scripts/login_status.php',
            method: 'GET',
            success: function(response) {
                var isLoggedIn = response.isLoggedIn;
                var email = response.email;
                var dynamicContent = document.getElementById('loginStatus');

                if (isLoggedIn) {
                    var profileButton = document.createElement('a');
                    profileButton.className = 'login_button u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-body-alt-color u-btn-5';
                    profileButton.href = 'My_Profile.html';
                    profileButton.innerHTML = '<span class="u-file-icon u-icon u-icon-5"><img src="images/6681235.png" alt=""></span>&nbsp;' + email;
                    dynamicContent.appendChild(profileButton);
                } else {
                    var loginButton = document.createElement('a');
                    loginButton.className = 'login_button u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-body-alt-color u-btn-5';
                    loginButton.href = 'Login_Page.html';
                    loginButton.innerHTML = '<span class="u-file-icon u-icon u-icon-5"><img src="images/6681235.png" alt=""></span>&nbsp;Log In';
                    dynamicContent.appendChild(loginButton);
                }
            },
            error: function() {
                console.log('Error fetching login status.');
            }
        });
    } else {
        // Hide the loginStatus button on the login page
        var loginStatusButton = document.getElementById('loginStatus');
        loginStatusButton.style.display = 'none';
    }
});
