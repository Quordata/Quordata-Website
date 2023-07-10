// Function to make an AJAX request to the PHP script
function fetchData() {
  var xmlhttp = new XMLHttpRequest();
  var urlParams = new URLSearchParams(window.location.search);

  // Retrieve the 'q' parameter value
  var query = urlParams.get('q');

  // Retrieve the 't' parameter value, if it exists
  var ticker = urlParams.has('t') ? urlParams.get('t') : null;

  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      var response = JSON.parse(xmlhttp.responseText);
      var button = document.getElementById("toggleTranscriptDisplay");
      var transcriptDiv = document.getElementById("transcriptText");

      if (response.error) {
        // If "Company not found" error is returned, hide the button
        button.style.display = "none";
      } else {
        // Update the text of the toggleButton
        button.textContent = "Read the full " + response.query + " " + response.ticker + " Q" + response.quarter + " " + response.year + " earnings call";

        // Parse and display the transcript
        var transcriptArray = JSON.parse(response.transcript);
        var transcriptHTML = '';

        transcriptArray.forEach(function(entry) {
          transcriptHTML += '<p><strong>' + entry.speaker + '</strong></p>';
          transcriptHTML += '<p>' + entry.text + '</p>';
        });

        transcriptDiv.innerHTML = transcriptHTML;
		
		var transcriptSummary = document.getElementById("transcriptSummary");
		transcriptSummary.textContent = response.summary;
		
		var transcriptSentiment = document.getElementById("transcriptSentiment");
		transcriptSentiment.innerHTML = "The overall sentiment for this earnings call was <strong>" + (response.sentiment === "1" ? "positive" : "negative") + "</strong>.";
      }
    }
  };
  // Specify the URL of the PHP script and include the 'q' parameter
	var url = "scripts/get_latest_earnings_transcripts.php?q=" + encodeURIComponent(query);

	// Check if the 't' parameter exists and add it to the URL if it does
	if (ticker) {
	  url += "&t=" + encodeURIComponent(ticker);
	}
	
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

// Call the fetchData function when the page finishes loading
window.addEventListener('load', fetchData);
