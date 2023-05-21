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
					profileButton.style.fontSize = '18px';
                    dynamicContent.appendChild(profileButton);
                } else {
                    var loginButton = document.createElement('a');
                    loginButton.href = 'Login_Page.html';
                    loginButton.innerHTML = '<span class="u-file-icon u-icon u-icon-5"></span>&nbsp;Log In';
					loginButton.style.backgroundColor = '#478ac9'; // Set background color to #478ac9
                    loginButton.style.color = 'white'; // Set text color to white
                    loginButton.style.fontSize = '18px'; // Set font size to 18px
					loginButton.style.borderRadius = '50px'; // Set border radius to 50px
                    loginButton.style.padding = '6px 12px'; // Adjust padding as needed
					loginButton.style.whiteSpace = 'nowrap'; // Prevent text wrapping

                    var signUpButton = document.createElement('a');
                    signUpButton.href = 'Sign_Up.html';
                    signUpButton.innerHTML = '<span class="u-file-icon u-icon u-icon-5"></span>&nbsp;Sign Up';
					signUpButton.style.backgroundColor = '#ee9e1c'; // Set background color to #ee9e1c
                    signUpButton.style.color = 'white'; // Set text color to white
                    signUpButton.style.fontSize = '18px'; // Set font size to 18px
					signUpButton.style.borderRadius = '50px'; // Set border radius to 50px
                    signUpButton.style.padding = '6px 12px'; // Adjust padding as needed
					signUpButton.style.whiteSpace = 'nowrap'; // Prevent text wrapping
					signUpButton.style.marginLeft = '10px';

                    var buttonContainer = document.createElement('div');
                    buttonContainer.className = 'button-container';
					buttonContainer.style.display = 'flex';
                    buttonContainer.appendChild(loginButton);
                    buttonContainer.appendChild(signUpButton);
                    dynamicContent.appendChild(buttonContainer);
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
