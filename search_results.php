<!DOCTYPE html>
<html style="font-size: 16px;" lang="en-US">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title id="query_title">Query</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Beta_Amazon.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.10.10, nicepage.com">
    <meta name="referrer" content="origin">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sigma.js/2.0.0-alpha23/sigma-graphology.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sigma.js/2.0.0-alpha23/sigma.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
      window.onload = function() {
        $(function() {
          $("#sentiment-price-chart").load("PriceSentimentScripts/Amazon.html");
        });
      }
    </script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Beta",
        "logo": "images/QuordataOrange.png"
      }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="meta_title_property">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
    <script>
      // Retrieve the query parameter from the URL using JavaScript
      var urlParams = new URLSearchParams(window.location.search);
      var query = urlParams.get('q');
      // Set the content of the meta tag using the query parameter
      var queryTitle = document.getElementById("query_title");
      queryTitle.content = query;
    var queryTitleProperty = document.querySelector('meta[property="og:title"]');
    queryTitleProperty.content = query;
    </script>
  </head>
  <body class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-custom-color-5 u-header u-valign-middle u-header" id="sec-1f2c"> <?php
  // Retrieve the query parameter from the URL
  $query = $_GET['q'];
  
  // Remove characters after the first whitespace
  $modifiedUserQuery = trim(strstr($query, ' ', true));
  
  $encquery = urlencode($modifiedUserQuery);
  
  // Define the Google Custom Search API endpoint and parameters
  $cse_image_id = '91150f2633e924c3f';
  $api_key = 'AIzaSyBV4it0BbqYYJ2H951xsx0ts1XJG0J79jg';
  $image_endpoint = "https://www.googleapis.com/customsearch/v1?q={$encquery}&cx={$cse_image_id}&imgSize=medium&imgType=photo&searchType=image&key={$api_key}";
  
  // Make a GET request to the API endpoint
  $json = file_get_contents($image_endpoint);
  
  // Parse the JSON response
  $response = json_decode($json);
  
  // Get the URL of the second image result
  $image_url = $response->items[0]->link;
  
  // Construct the RSS feed URL with the query parameter
  $rss_feed_url = "https://news.google.com/rss/search?q={$encquery}&hl=en-US&gl=US&ceid=US:en";
  
  // Fetch the RSS feed
  $rss = file_get_contents($rss_feed_url);
  
  // Parse the RSS feed
  $feed = simplexml_load_string($rss);
  
  // Get the first news item and display the headline and URL
  $item = $feed->channel->item[0];
  $headline = $item->title;
  $article_url = $item->link;
  
  ?> <a href="Home.html" class="u-align-left u-image u-logo u-image-1" data-image-width="876" data-image-height="299" title="Home">
        <img src="images/QuordataOrange.png" class="u-logo-image u-logo-image-1">
      </a>
      <div class="u-clearfix u-group-elements u-group-elements-1">
        <p class="u-align-center u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-1">
          <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-body-alt-color u-btn-1" href="Learn.html">
            <span class="u-file-icon u-icon u-icon-1">
              <img src="images/5766916.png" alt="">
            </span>&nbsp;Learn More </a>
        </p>
        <p class="u-align-center u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-2">
          <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-body-alt-color u-btn-2" href="Team.html">
            <span class="u-file-icon u-icon u-icon-2">
              <img src="images/476863.png" alt="">
            </span>&nbsp;Team </a>
        </p>
        <p class="u-align-center u-text u-text-3">
          <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-body-alt-color u-btn-3" href="https://twitter.com/QuordataApp" target="_blank">
            <span class="u-file-icon u-icon u-icon-3">
              <img src="images/3128310.png" alt="">
            </span>&nbsp;Follow Us </a>
        </p>
        <p class="u-align-center u-text u-text-4">
          <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-body-alt-color u-btn-4" href="mailto:hello@quordata.com">
            <span class="u-file-icon u-icon u-icon-4">
              <img src="images/4386562.png" alt="">
            </span>&nbsp;Email Us </a>
        </p>
      </div>
      <div class="u-clearfix u-custom-html u-custom-html-1">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="scripts/account_header.js"></script>
        <div id="loginStatus"></div>
      </div>
    </header>
    <section class="u-clearfix u-palette-1-light-3 u-section-1" id="sec-bc09">
      <div class="u-align-left u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-custom-html u-custom-html-1">
          <button type="submit" onclick="set_timeframe(this.value)" id="set_day" class="u-border-none u-btn u-btn-1 u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-50 u-btn-1" value="Day">
            <p style="margin-top: -7px;">
              <b style="">Day</b>
            </p>
          </button>
          <button type="submit" onclick="set_timeframe(this.value)" id="set_week" class="u-border-none u-btn u-btn-1 u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-50 u-btn-2" value="Week">
            <p style="margin-top: -7px;">
              <b style="">Week</b>
            </p>
          </button>
          <button type="submit" onclick="set_timeframe(this.value)" id="set_month" class="u-border-none u-btn u-btn-1 u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-50 u-btn-3" value="Month">
            <p style="margin-top: -7px;">
              <b style="">Month</b>
            </p>
          </button>
          <button type="submit" onclick="set_timeframe(this.value)" id="set_year" class="u-border-none u-btn u-btn-1 u-btn-round u-button-style u-hover-palette-1-light-1 u-palette-3-base u-radius-50 u-btn-4" value="Year">
            <p style="margin-top: -7px;">
              <b style="">Year</b>
            </p>
          </button>
          <label for="start-date" style="width: 100px; height: 28px; margin-top: 58px; margin-left: 475px; position: absolute">Start Date:</label>
          <input type="date" id="start-date" name="start-date" style="width: 160px; height: 28px; margin-top: 58px; margin-left: 570px; position: absolute">
          <label for="end-date" style="width: 100px; height: 28px; margin-top: 58px; margin-left: 750px; position: absolute">End Date:</label>
          <input type="date" id="end-date" name="end-date" style="width: 160px; height: 28px; margin-top: 58px; margin-left: 845px; position: absolute" disabled="">
          <script>
            // get references to the start date and end date input fields
            const startDateInput = document.getElementById('start-date');
            const endDateInput = document.getElementById('end-date');
            // add an event listener to the start date input field
            startDateInput.addEventListener('change', function() {
              // when the start date is changed, enable the end date input field
              endDateInput.disabled = false;
              // set the minimum value for the end date input field to the selected start date
              endDateInput.min = startDateInput.value;
            });
            // add an event listener to the end date input field
            endDateInput.addEventListener('change', function() {
              // parse the start date and end date values into Date objects
              const startDate = new Date(startDateInput.value);
              const endDate = new Date(endDateInput.value);
              // format the start date and end date using the desired format
              const formattedStartDate = startDate.toLocaleDateString('en-US', {
                month: '2-digit',
                day: '2-digit',
                year: '2-digit'
              });
              const formattedEndDate = endDate.toLocaleDateString('en-US', {
                month: '2-digit',
                day: '2-digit',
                year: '2-digit'
              });
              // concatenate the formatted start date and end date values into a single string
              const concatenatedDates = formattedStartDate + '-' + formattedEndDate;
              set_timeframe(concatenatedDates)
            });
          </script>
          <script>
            function set_timeframe(timeframe) {
              if (timeframe == "Day") {
                pos_sent = "-7%";
                tweets_analyzed = "28";
                conf_score = "91";
                ave_score = "70";
                time_range = "9/29-9/30"
              } else if (timeframe == "Week") {
                pos_sent = "-2%";
                tweets_analyzed = "173";
                conf_score = "83";
                ave_score = "80";
                time_range = "9/23-9/30"
              } else if (timeframe == "Month") {
                pos_sent = "+5%";
                tweets_analyzed = "867";
                conf_score = "81";
                ave_score = "80";
                time_range = "9/1-9/30"
              } else if (timeframe == "Year") {
                pos_sent = "+11%";
                tweets_analyzed = "9,814";
                conf_score = "84";
                ave_score = "71";
                time_range = "9/30/21-9/30/22"
              } else {
                pos_sent = "+11%";
                tweets_analyzed = "9,814";
                conf_score = "84";
                ave_score = "71";
                time_range = timeframe
              }
              var happening_summarys = document.getElementsByClassName("happening_summary");
				var happening_summary = happening_summarys[0];
				var span1 = document.createElement("span");
				span1.style.fontWeight = "700";
				span1.textContent = query;

				var span2 = document.createElement("span");
				span2.style.fontWeight = "700";
				span2.textContent = "positive";

				var span3 = document.createElement("span");
				span3.style.fontWeight = "700";
				span3.textContent = timeframe.toLowerCase();

				var span4 = document.createElement("span");
				span4.style.fontWeight = "700";
				span4.textContent = ave_score;

				var span5 = document.createElement("span");
				span5.style.fontWeight = "700";
				span5.textContent = "%";

				happening_summary.innerHTML = "";
				happening_summary.appendChild(span1);
				happening_summary.innerHTML += "&nbsp;has been experiencing ";
				happening_summary.appendChild(span2);
				happening_summary.innerHTML += " sentiment the past ";
				happening_summary.appendChild(span3);
				happening_summary.innerHTML += " with an average sentiment score of ";
				happening_summary.appendChild(span4);
				happening_summary.appendChild(span5);

              var positive_scores = document.getElementsByClassName("positive_score");
              var positive_score = positive_scores[0];
              positive_score.innerHTML = `
																											
																											
																											
																											
																											
																											<b>${pos_sent}</b>`;
              var confidence_scores = document.getElementsByClassName("confidence_score");
              var confidence_score = confidence_scores[0];
              confidence_score.innerHTML = `
																											
																											
																											
																											
																											
																											<b>${conf_score}</b>`;
              var tweet_counts = document.getElementsByClassName("tweet_count");
              var tweet_count = tweet_counts[0];
              tweet_count.innerHTML = `
																											
																											
																											
																											
																											
																											<b>${tweets_analyzed}</b>`;
              var average_scores = document.getElementsByClassName("average_score");
              var average_score = average_scores[0];
              average_score.innerHTML = `
																											
																											
																											
																											
																											
																											<b>${ave_score}</b>`;
              var sentiment_over_times = document.getElementsByClassName("sentiment_over_time");
              var sentiment_over_time = sentiment_over_times[0];
              sentiment_over_time.innerHTML = `
																											
																											
																											
																											
																											
																											<b>SENTIMENT OVER TIME (${time_range})</b>`;
				var insight_summarys = document.getElementsByClassName("insight_summary");
				var insight_summary = insight_summarys[0];
				var span1 = document.createElement("span");
				span1.style.fontWeight = "700";
				span1.textContent = query;

				var span2 = document.createElement("span");
				span2.style.fontWeight = "700";
				span2.textContent = "negative";

				var span3 = document.createElement("span");
				span3.style.fontWeight = "700";
				span3.textContent = "previous " + timeframe.toLowerCase();

				insight_summary.innerHTML = "Quordata notes ";
				insight_summary.appendChild(span1);
				insight_summary.innerHTML += " stock has been trading in a ";
				insight_summary.appendChild(span2);
				insight_summary.innerHTML += " trend the ";
				insight_summary.appendChild(span3);
				insight_summary.innerHTML += ".";

              var insight_predictions = document.getElementsByClassName("insight_prediction");
              var insight_prediction = insight_predictions[0];
              insight_prediction.innerHTML = `
																											
																											
																											
																											
																											
																											<b>Quordata has seen that when the 1-${timeframe.toLowerCase()} sentiment score is positive, price tends to rise the following ${timeframe.toLowerCase()} by 1-5%.</b>`;
            }
          </script>
        </div>
        <div class="u-container-style u-group u-palette-1-base u-radius-26 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <p class="u-align-center u-text u-text-1">
              <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-body-alt-color u-btn-5" href="Home.html">BACK</a>
            </p>
          </div>
        </div>
        <div class="u-clearfix u-custom-html u-custom-html-2">
          <script src="scripts/request_query_subscribe.js"></script>
          <div style="display: flex; align-items: center; white-space: nowrap;">
            <button id="subscribe_button" class="u-palette-1-base u-radius-26 u-shape-round" onmouseover="this.style.color = 'gray';" onmouseout="this.style.color = 'white';" style="border: none; margin-left: 10px; cursor: pointer; font-weight: bold;">SUBSCRIBE</button>
            <p id="response_text" style="display: none; margin-left: 10px; color: #ee9e1c; font-weight: bold;"></p>
          </div>
          <script>
            $(document).ready(function() {
              // Use AJAX to fetch the login status from a PHP script
              $.ajax({
                url: 'scripts/login_status.php',
                method: 'GET',
                success: function(response) {
                  var isLoggedIn = response.isLoggedIn;
                  var userID = response.userID;
                  if (!isLoggedIn) {
                    // User is not logged in, hide the subscribe button
                    $('#subscribe_button').hide();
                  } else {
                    // Get the query name from the current URL
                    var queryName = getQueryNameFromURL();
                    // Check subscription status
                    $.ajax({
                      url: 'scripts/subscription_status.php',
                      method: 'GET',
                      data: {
                        userID: userID,
                        queryName: queryName
                      },
                      success: function(subscriptionResponse) {
                        var isSubscribed = subscriptionResponse.isSubscribed;
                        if (isSubscribed) {
                          // User is already subscribed, change button text to "Unsubscribe"
                          $('#subscribe_button').text('UNSUBSCRIBE');
                        }
                      },
                      error: function() {
                        console.log('Error fetching subscription status.');
                      }
                    });
                  }
                },
                error: function() {
                  console.log('Error fetching login status.');
                }
              });
            });

            function getQueryNameFromURL() {
              var queryName = null;
              if (window.location.href.includes('search_results.php')) {
                // If the URL is formatted as 'https://www.quordata.com/search_results.php?q=QUERY'
                var urlParams = new URLSearchParams(window.location.search);
                queryName = urlParams.get('q');
              } else if (window.location.href.includes('Beta_')) {
                // If the URL is formatted as 'https://www.quordata.com/Beta_QUERY'
                var urlParts = window.location.href.split('Beta_');
                queryName = urlParts[1];
              }
              return queryName;
            }
          </script>
        </div>
        <img class="u-image u-image-round u-preserve-proportions u-radius-21 u-image-1" src="<?php echo $image_url; ?>" alt="" data-image-width="1500" data-image-height="844">
        <div class="u-clearfix u-custom-html u-custom-html-3">
          <button type="submit" onclick="toggle_source(this.id)" id="toggle_twitter" class="u-border-none u-btn u-btn-1 u-btn-round u-palette-3-base u-radius-50 u-btn-6" value="1">
            <p style="margin-top: -7px;">
              <b style="">Twitter</b>
            </p>
          </button>
          <button type="submit" onclick="toggle_source(this.id)" id="toggle_reddit" class="u-border-none u-btn u-btn-1 u-btn-round u-palette-3-base u-radius-50 u-btn-7" value="1">
            <p style="margin-top: -7px;">
              <b style="">Reddit</b>
            </p>
          </button>
          <button type="submit" onclick="toggle_source(this.id)" id="toggle_youtube" class="u-border-none u-btn u-btn-1 u-btn-round u-palette-3-base u-radius-50 u-btn-8" value="1">
            <p style="margin-top: -7px;">
              <b style="">YouTube</b>
            </p>
          </button>
          <button type="submit" onclick="toggle_source(this.id)" id="toggle_news" class="u-border-none u-btn u-btn-1 u-btn-round u-palette-3-base u-radius-50 u-btn-9" value="1">
            <p style="margin-top: -7px;">
              <b style="">News</b>
            </p>
          </button>
          <script>
            function toggle_source(source) {
              target = document.getElementById(source);
              twitter_pos_sent = 8;
              twitter_conf_score = 91;
              twitter_ave_score = 70;
              reddit_pos_sent = 3;
              reddit_conf_score = 83;
              reddit_ave_score = 80;
              youtube_pos_sent = 3;
              youtube_conf_score = 71;
              youtube_ave_score = 70;
              news_pos_sent = 5;
              news_conf_score = 84;
              news_ave_score = 71;
              if (target.value == "1") {
                target.value = "0";
                target.style.background = "#898989";
              } else {
                target.value = "1";
                target.style.background = "#f1c50e";
              }
              twitter_source_state = parseInt(document.getElementById("toggle_twitter").value);
              reddit_source_state = parseInt(document.getElementById("toggle_reddit").value);
              youtube_source_state = parseInt(document.getElementById("toggle_youtube").value);
              news_source_state = parseInt(document.getElementById("toggle_news").value);
              num_on = twitter_source_state + reddit_source_state + youtube_source_state + news_source_state;
              if (num_on < 4) {
                pos_sent = `+${Math.round((twitter_pos_sent*twitter_source_state + reddit_pos_sent*reddit_source_state + youtube_pos_sent*youtube_source_state + news_pos_sent*news_source_state) / num_on)}%`;
                conf_score = `${Math.round((twitter_conf_score*twitter_source_state + reddit_conf_score*reddit_source_state + youtube_conf_score*youtube_source_state + news_conf_score*news_source_state) / num_on)}%`;
                ave_score = `${Math.round((twitter_ave_score*twitter_source_state + reddit_ave_score*reddit_source_state + youtube_ave_score*youtube_source_state + news_ave_score*news_source_state) / num_on)}%`;
              } else if (num_on == 0) {
                pos_sent = "NaN";
                conf_score = "NaN";
                ave_score = "NaN";
              } else {
                pos_sent = "+5%";
                conf_score = "81%";
                ave_score = "80%";
              }
              var positive_scores = document.getElementsByClassName("positive_score");
              var positive_score = positive_scores[0];
              positive_score.innerHTML = `
																												<b>${pos_sent}</b>`;
              var confidence_scores = document.getElementsByClassName("confidence_score");
              var confidence_score = confidence_scores[0];
              confidence_score.innerHTML = `
																												<b>${conf_score}</b>`;
              var average_scores = document.getElementsByClassName("average_score");
              var average_score = average_scores[0];
              average_score.innerHTML = `
																												<b>${ave_score}</b>`;
            }
          </script>
        </div>
        <div class="u-container-style u-group u-palette-1-base u-radius-26 u-shape-round u-group-2">
          <div class="u-container-layout u-container-layout-2">
            <p class="u-align-center u-text u-text-2"> <?php echo strtoupper($query); ?> </p>
          </div>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-grey-10 u-section-2" id="sec-6b72">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-gutter-0 u-layout">
            <div class="u-layout-col">
              <div class="u-size-20">
                <div class="u-layout-row">
                  <div class="u-container-style u-custom-color-5 u-layout-cell u-size-6 u-layout-cell-1">
                    <div class="u-container-layout u-container-layout-1">
                      <div class="u-clearfix u-group-elements u-group-elements-1" data-href="My_Profile.html">
                        <h1 class="u-text u-title u-text-1">My Profile</h1>
                        <span class="u-file-icon u-icon u-icon-rectangle u-text-white u-icon-1">
                          <img src="images/666201-8050f29d.png" alt="">
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-37 u-white u-layout-cell-2">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-2">
                      <h1 class="u-align-center u-text u-text-custom-color-5 u-text-default u-title u-text-2">WHAT'S HAPPENING?</h1>
                      <div class="u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-1">
                        <div class="u-container-layout u-container-layout-3">
                          <p class="happening_summary u-text u-text-default u-text-3">
                            <span style="font-weight: 700;"> <?php echo $query; ?> </span>&nbsp;has been experiencing <span style="font-weight: 700;">positive </span>sentiment the past <span style="font-weight: 700;">month </span>with an average sentiment score of <span style="font-weight: 700;"> 80</span>
                            <span style="font-weight: 700;">%</span>
                          </p>
                          <span class="u-file-icon u-icon u-icon-2">
                            <img src="images/5231421.png" alt="">
                          </span>
                        </div>
                      </div>
                      <div class="u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-2">
                        <div class="u-container-layout u-container-layout-4">
                          <p class="u-text u-text-body-color u-text-default u-text-4"> Quordata believes the biggest driver of this <span style="font-weight: 700;">positive </span>sentiment comes from <span style="font-weight: 700;">news <?php echo $headline; ?> </span> &nbsp;( <a href="
																																							<?php echo $article_url; ?>" class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-1" target="_blank">Link </a>). </p>
                        </div>
                      </div>
                      <span class="u-file-icon u-icon u-icon-3">
                        <img src="images/4395935.png" alt="">
                      </span>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-17 u-white u-layout-cell-3">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-5">
                      <h1 class="u-text u-text-custom-color-5 u-text-default u-title u-text-5">KEY METRICS</h1>
                      <div class="u-align-left u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-3">
                        <div class="u-container-layout u-container-layout-6">
                          <p class="tweet_count u-align-left u-text u-text-body-color u-text-6">867</p>
                          <span class="u-file-icon u-icon u-text-palette-4-base u-icon-4">
                            <img src="images/64673-cadf79d1.png" alt="">
                          </span>
                          <p class="u-align-left u-text u-text-body-color u-text-7">Tweets&nbsp; <br>Analyzed </p>
                        </div>
                      </div>
                      <div class="u-align-left u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-4">
                        <div class="u-container-layout u-container-layout-7">
                          <p class="positive_score u-align-left u-text u-text-8">+5%</p>
                          <span class="u-file-icon u-icon u-icon-5">
                            <img src="images/3588171.png" alt="">
                          </span>
                          <p class="u-align-left u-text u-text-body-color u-text-9">Change Over Time</p>
                        </div>
                      </div>
                      <div class="u-align-left u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-5">
                        <div class="u-container-layout u-container-layout-8">
                          <span class="u-file-icon u-icon u-icon-6">
                            <img src="images/456115.png" alt="">
                          </span>
                          <p class="confidence_score u-align-left u-text u-text-body-color u-text-10">81</p>
                          <p class="u-align-left u-text u-text-body-color u-text-11">Correlation Score</p>
                        </div>
                      </div>
                      <div class="u-align-left u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-6">
                        <div class="u-container-layout u-container-layout-9">
                          <p class="average_score u-align-left u-text u-text-body-color u-text-12">80%</p>
                          <span class="u-file-icon u-icon u-icon-7">
                            <img src="images/5184373.png" alt="">
                          </span>
                          <p class="u-align-left u-text u-text-body-color u-text-13">Average Sentiment Score</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="u-size-20">
                <div class="u-layout-row">
                  <div class="u-container-style u-custom-color-5 u-layout-cell u-size-6 u-layout-cell-4">
                    <div class="u-container-layout u-container-layout-10"></div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-17 u-white u-layout-cell-5">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-11">
                      <h1 class="u-align-center u-text u-text-custom-color-5 u-text-default u-title u-text-14">OUR INSIGHTS</h1>
                      <div class="u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-7">
                        <div class="u-container-layout u-container-layout-12">
                          <span class="u-file-icon u-icon u-icon-8">
                            <img src="images/4730727.png" alt="">
                          </span>
                          <p class="insight_summary u-text u-text-body-color u-text-15"> Quordata notes <span style="font-weight: 700;"> <?php echo $query; ?> </span>stock has been trading in a <span style="font-weight: 700;">negative </span>trend the <span style="font-weight: 700;">previous month</span>. </p>
                        </div>
                      </div>
                      <div class="u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-8">
                        <div class="u-container-layout u-container-layout-13">
                          <p class="insight_prediction u-text u-text-body-color u-text-default u-text-16">Quordata has seen that when the 1-month sentiment score is positive, price tends to rise the following month by 1-5%.&nbsp;</p>
                        </div>
                      </div>
                      <span class="u-file-icon u-icon u-icon-9">
                        <img src="images/4175914.png" alt="">
                      </span>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-37 u-white u-layout-cell-6">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-14">
                      <p class="sentiment_over_time u-text u-text-custom-color-5 u-text-default u-text-17">SENTIMENT OVER TIME (9/1-9/30)</p>
                      <div class="u-clearfix u-custom-html u-custom-html-1">
                        <div id="sentiment-price-chart"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="u-size-20">
                <div class="u-layout-row">
                  <div class="u-container-style u-custom-color-5 u-layout-cell u-size-6 u-layout-cell-7">
                    <div class="u-container-layout u-container-layout-15"></div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-28 u-white u-layout-cell-8">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-16">
                      <p class="u-text u-text-custom-color-5 u-text-default u-text-18">CLOSELY RELATED TOPICS</p>
                      <div class="u-clearfix u-custom-html u-custom-html-2">
                        <div id="related-topics-container" style="height: 350px; width: 520px; position: absolute; background-color: transparent; z-index: 9999;"></div>
                        <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Retrieve the query parameter from the URL using JavaScript
    var urlParams = new URLSearchParams(window.location.search);
    var userQuery = urlParams.get('q');
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      redirect: 'follow'
    };
	
	// Remove characters after the first whitespace
	userQuery = decodeURIComponent(userQuery).split(' ')[0];
    const url = `https://apxhx30s83.execute-api.us-west-1.amazonaws.com/prod/google_trends_resource?topic=${userQuery}`;
    const container = document.getElementById('related-topics-container');
    let graph = new graphology.Graph();
    // Add center node
    graph.addNode(userQuery, {
      label: userQuery,
      size: 10,
      color: '#ec5148',
      x: 0,
      y: 0
    });
    const settings = {
      minNodeSize: 5,
      maxNodeSize: 20,
      minEdgeSize: 1,
      maxEdgeSize: 5,
      defaultNodeColor: '#ee9e1c',
      edgeColor: 'default',
      defaultEdgeColor: '#ccc'
    };
    fetch(url, requestOptions).then(response => {
      if (!response.ok) {
        throw new Error('Failed to get related topics');
      }
      return response.json();
    }).then(result => {
      if (result.length > 6) {
        result = result.slice(0, 6);
      }
      let relatedTopics = [...new Set(result)];
      // Remove userQuery from relatedTopics
      relatedTopics = relatedTopics.filter(topic => topic !== userQuery);
      // Make AJAX request to store topics in MySQL
      const storeTopicsURL = 'scripts/get_closely_related_topics.php';
      // Define the data to be sent in the request body
      const requestBody = {
        userQuery: userQuery,
        topics: relatedTopics
      };
      const storeTopicsRequestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: JSON.stringify(requestBody),
        redirect: 'follow'
      };
      // Make the AJAX request to store topics in MySQL
      fetch(storeTopicsURL, storeTopicsRequestOptions).then(response => {
        if (!response.ok) {
          // Use the current relatedTopics array if storing failed
          return relatedTopics;
        }
        return response.json();
      }).then(result => {
        // Retrieve the stored topics from the response (if needed)
        let relatedTopics = [...new Set(result)];
        // Add related topics as nodes and edges to center node
        relatedTopics.forEach(function(topic, index) {
          var angle = (index / relatedTopics.length) * 2 * Math.PI;
          var x = 150 * Math.cos(angle);
          var y = 150 * Math.sin(angle);
          graph.addNode(topic, {
            label: topic,
            size: 10,
            color: '#777',
            x: x,
            y: y
          });
          graph.addEdgeWithKey('edge' + (index + 1), userQuery, topic, {
            color: '#ccc'
          });
        });
        graph.nodes().forEach(node => {
          graph.mergeNodeAttributes(node, {
            label: node,
            size: 15,
            color: '#ee9e1c'
          });
        });
        const renderer = new Sigma.WebGLRenderer(graph, container, settings);
        const camera = renderer.getCamera();
        const captor = renderer.getMouseCaptor();
        // State
        let draggedNode = null,
          dragging = false;
        renderer.on('downNode', e => {
          dragging = true;
          draggedNode = e.node;
          camera.disable();
        });
        captor.on('mouseup', e => {
          dragging = false;
          draggedNode = null;
          camera.enable();
        });
        captor.on('mousemove', e => {
          if (!dragging) return;
          // Get new position of node
          const pos = renderer.normalizationFunction.inverse(camera.viewportToGraph(renderer, e.x, e.y));
          graph.setNodeAttribute(draggedNode, 'x', pos.x);
          graph.setNodeAttribute(draggedNode, 'y', pos.y);
        });
        renderer.on('clickNode', e => {
          const node = e.node;
          const nodeLabel = graph.getNodeAttribute(node, 'label');
          if (nodeLabel !== userQuery) {
            const url = 'http://quordata.com/search_results.php?q=' + nodeLabel;
            window.open(url, '_blank');
          }
        });
        window.graph = graph;
        window.renderer = renderer;
        window.camera = renderer.getCamera();
      })
    }).catch(error => {
      console.error('Error storing related topics:', error);
    });
  });
</script>
                      </div>
                    </div>
                  </div>
                  <div class="u-container-style u-layout-cell u-size-26 u-white u-layout-cell-9">
                    <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-17">
                      <p class="u-text u-text-custom-color-5 u-text-default u-text-19">SOURCES TREEMAP <br>
                      </p>
                      <div class="u-clearfix u-custom-html u-custom-html-3">
                        <div id="sources-treemap" style="width: 400px; height: 520px;"></div>
                        <script>
                          document.addEventListener('DOMContentLoaded', function() {
                            // Load CSV data
                            Papa.parse('data/sources_composition.csv', {
                              header: true,
                              download: true,
                              complete: function(results) {
                                var rdata = results.data;
                                // Get user query
                                var userQuery = 'Amazon';
                                // Find related topics
                                var data = rdata.map(function(row) {
                                  return row[userQuery];
                                });
                                let labels = ['Twitter', 'Yahoo Finance', 'Reddit', 'Motley Fool', 'Other'];
                                let images = ['images/twitter_logo.png', 'images/yahoofinance_logo.png', 'images/reddit_logo.png', 'images/motley_logo.webp', 'images/news_logo.png'];
                                const svg = d3.select('#sources-treemap').append('svg').attr('width', 400).attr('height', 520);
                                const treemapLayout = (data, labels, images) => d3.treemap().tile(d3.treemapSquarify).size([460, 520]).padding(1).round(false)(d3.hierarchy({
                                    values: data.map((value, i) => ({
                                      value,
                                      index: i
                                    })),
                                  },
                                  (d) => d.values).sum((d) => d.value));
                                const treemapData = treemapLayout(data, labels, images);
                                const treemapContainer = d3.select("#sources-treemap");
                                const treemapSquares = treemapContainer.selectAll("div").data(treemapData.leaves()).join("div").attr("id", (d) => labels[d.data.index]).attr("style", (d) => {
                                  let backgroundColor = "#ccc"; // Default background color
                                  // Set background color based on label
                                  if (labels[d.data.index] === "Twitter") {
                                    backgroundColor = "#94c7cb";
                                  } else if (labels[d.data.index] === "Yahoo Finance") {
                                    backgroundColor = "#cdbcfc";
                                  } else if (labels[d.data.index] === "Reddit") {
                                    backgroundColor = "#ff8f66";
                                  } else if (labels[d.data.index] === "Motley Fool") {
                                    backgroundColor = "#f1babc";
                                  }
                                  return `
            position: absolute;
            left: ${d.x0}px;
            top: ${d.y0}px;
            width: ${d.x1 - d.x0}px;
            height: ${d.y1 - d.y0}px;
            background-color: ${backgroundColor};
            overflow: hidden;
          `;
                                });
                                treemapSquares.append("img").attr("src", (d) => images[d.data.index]).style("max-width", "100%").style("max-height", "100%").style("object-fit", "contain").style("position", "absolute").style("top", "50%").style("left", "50%").style("transform", "translate(-50%, -50%)");
                                treemapSquares.append("div").attr("class", "source_label").attr("style", (d) => `
                    padding: 5px;
                        box-sizing: border-box;
    font-size: ${Math.min((d.x1 - d.x0) / 8, 14)}px;
    text-overflow: ellipsis;
    overflow: hidden;
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    display: flex;
                    color: #fff;
    word-wrap: break-word; /* Enable word wrapping */
                `).text((d) => `${labels[d.data.index]}\n${data[d.data.index]}%`);
                                treemapSquares.on('click', function(d) {
                                  var source = 'toggle_news';
                                  var square = d3.select(this);
                                  var source_label = square.select('.source_label'); // Select the inner div element with the class 'source_label'
                                  if (this.id == 'Twitter') {
                                    source = 'toggle_twitter';
                                  } else if (this.id == 'Reddit') {
                                    source = 'toggle_reddit';
                                  } else if (this.id == 'Yahoo Finance') {
                                    source = 'toggle_news';
                                  } else if (this.id == 'Motley Fool') {
                                    source = 'toggle_news';
                                  } else if (this.id == 'Other') {
                                    source = 'toggle_youtube';
                                  }
                                  toggle_source(source);
                                  // Toggle background color, text color, and border
                                  if (square.classed('toggled')) {
                                    // Square is already toggled, reset the style
                                    square.style('background-color', square.attr('data-original-bg')).style('border', null).classed('toggled', false);
                                    source_label.style('color', square.attr('data-original-color'));
                                  } else {
                                    // Square is not toggled, apply the new style
                                    square.attr('data-original-bg', square.style('background-color')) // Store the original background color
                                      .attr('data-original-color', source_label.style('color')); // Store the original text color
                                    square.style('background-color', 'white').style('border', '2px solid black').classed('toggled', true);
                                    source_label.style('color', 'black');
                                  }
                                });
                              }
                            })
                          });
                        </script>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="u-clearfix u-custom-html u-custom-html-4">
          <style>
            #video-overlay {
              display: none;
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              z-index: 9999;
              justify-content: center;
              align-items: center;
              background-color: rgba(0, 0, 0, 0.5);
            }

            #video-overlay iframe {
              width: 80%;
              height: 80%;
            }
          </style>
          <div id="video-overlay">
            <iframe id="video-iframe" src="https://www.youtube.com/embed/1OPV6rW1YMI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
          </div>
          <script>
            document.addEventListener('click', function(event) {
              const isClickInsideVideo = videoIframe.contains(event.target);
              const isClickInsideButton = playButton.contains(event.target);
              if (!isClickInsideVideo && !isClickInsideButton) {
                videoOverlay.style.display = 'none';
              }
            });
            $(document).ready(function() {
              // Use AJAX to fetch the login status from a PHP script
              $.ajax({
                url: 'scripts/login_status.php',
                method: 'GET',
                success: function(response) {
                  var isLoggedIn = response.isLoggedIn;
                  var userID = response.userID;
                  if (isLoggedIn) {
                    // Request PHP script to check if this is the user's first time opening a dashboard
                    $.ajax({
                      url: 'scripts/check_first_time.php',
                      method: 'POST',
                      data: {
                        userID: userID
                      },
                      success: function(response) {
                        if (response == "1") {
                          // First time user is viewing a dashboard, display tutorial
                          videoOverlay.style.display = 'flex';
                        }
                      },
                      error: function() {
                        console.log('Error checking first time status');
                      }
                    });
                  }
                },
                error: function() {
                  console.log('Error fetching login status.');
                }
              });
            });
          </script>
        </div>
        <div class="u-clearfix u-custom-html u-custom-html-5">
          <button id="start-tutorial" class="u-palette-1-base u-radius-26 u-shape-round" onmouseover="this.style.color = 'gray';" onmouseout="this.style.color = 'white';" style="border: none; margin-left: 10px; cursor: pointer; font-weight: bold;">TUTORIAL</button>
          <script>
            const playButton = document.getElementById('start-tutorial');
            const videoOverlay = document.getElementById('video-overlay');
            const videoIframe = document.getElementById('video-iframe');
            playButton.addEventListener('click', function() {
              videoOverlay.style.display = 'flex';
            });
          </script>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-grey-10 u-section-3" id="sec-f941">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-custom-color-5 u-layout-cell u-size-6 u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1"></div>
              </div>
              <div class="u-container-style u-layout-cell u-size-54 u-white u-layout-cell-2">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-2">
                  <div class="u-clearfix u-custom-html u-expanded-width u-custom-html-1">
                    <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/3180_RC01/embed_loader.js"></script>
                    <script type="text/javascript">
                      var queryName = getQueryNameFromURL();
                      trends.embed.renderExploreWidget("TIMESERIES", {
                        "comparisonItem": [{
                          "keyword": queryName,
                          "geo": "",
                          "time": "today 12-m"
                        }],
                        "category": 0,
                        "property": ""
                      }, {
                        "exploreQuery": "q=" + queryName + "&date=today 12-m",
                        "guestPath": "https://trends.google.com:443/trends/embed/"
                      });
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-grey-10 u-section-4" id="sec-904f">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-custom-color-5 u-layout-cell u-size-6 u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1"></div>
              </div>
              <div class="u-align-center u-container-style u-layout-cell u-size-54 u-white u-layout-cell-2">
                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-top u-container-layout-2">
                  <h1 class="u-text u-text-custom-color-5 u-text-default u-title u-text-1">EARNINGS TRANSCRIPT</h1>
                  <div class="u-container-style u-group u-palette-1-light-2 u-radius-10 u-shape-round u-group-1">
                    <div class="u-container-layout u-container-layout-3">
                      <div class="u-clearfix u-custom-html u-expanded-width u-custom-html-1">
                        <p id="transcriptSummary"></p>
                        <p id="transcriptSentiment"></p>
                      </div>
                    </div>
                  </div>
                  <div class="u-clearfix u-custom-html u-custom-html-2">
                    <button id="toggleTranscriptDisplay" onclick="toggleTranscript()" style="cursor: pointer;"></button>
                    <script src="scripts/request_earnings_call.js"></script>
                    <div id="transcriptText" style="display: none;"></div>
                    <script>
                      // Function to toggle the transcript display
                      function toggleTranscript() {
                        var transcriptDiv = document.getElementById("transcriptText");
                        if (transcriptDiv.style.display === "none") {
                          transcriptDiv.style.display = "block";
                        } else {
                          transcriptDiv.style.display = "none";
                        }
                      }
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-bc62">
      <div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Quordata LLC <br>All rights reserved. </p>
      </div>
    </footer>
  </body>
</html>