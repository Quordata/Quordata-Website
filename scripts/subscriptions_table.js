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

						  // Create the link based on the row value
						  var link;
						  if (['Amazon'].includes(queryName)) {
							link = 'https://www.quordata.com/Beta_' + queryName;
						  } else {
							link = 'https://www.quordata.com/search_results.php?q=' + queryName;
						  }

						  // Create the anchor element
						  var anchor = document.createElement('a');
						  anchor.href = link;
						  anchor.textContent = queryName;
						  anchor.style.color = 'white';

						  // Append the anchor element to the cell
						  cell.appendChild(anchor);

						  // Append the cell to the row
						  row.appendChild(cell);

						  // Append the row to the table body
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
