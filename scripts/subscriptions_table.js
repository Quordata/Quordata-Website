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
                    url: 'scripts/fetch_query_names.php',
                    method: 'GET',
                    data: { userID: userID },
                    success: function(queryResponse) {
                        var queryNames = queryResponse.queryNames;
                        var tableBody = document.getElementById('subscriptions_tbody');

                        for (var i = 0; i < queryNames.length; i++) {
                            var queryName = queryNames[i];
                            var row = document.createElement('tr');
                            var cell = document.createElement('td');
                            cell.className = 'u-border-3 u-border-grey-dark-1 u-table-cell';
                            cell.textContent = queryName;
                            row.appendChild(cell);
                            tableBody.appendChild(row);
                        }
                    },
                    error: function() {
                        console.log('Error fetching query names.');
                    }
                });
            }
        },
        error: function() {
            console.log('Error fetching login status.');
        }
    });
});
