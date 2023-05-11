<?php

// Get the topic from the query string
$topic = $_GET['q'];

// Construct the URL with the topic and API key
$url = "https://trends.google.com/trends/api/widgetdata/relatedsearches?hl=en-US&tz=420&req={\"restriction\":{\"geo\":{\"country\":\"US\"},\"time\":\"2023-04-08+2023-05-08\",\"originalTimeRangeForExploreUrl\":\"today+1-m\",\"complexKeywordsRestriction\":{\"keyword\":[{\"type\":\"BROAD\",\"value\":\"$topic\"}]}},\"keywordType\":\"ENTITY\",\"metric\":[\"TOP\",\"RISING\"],\"trendinessSettings\":{\"compareTime\":\"2023-03-08+2023-04-07\"},\"requestOptions\":{\"property\":\"\",\"backend\":\"IZG\",\"category\":0},\"language\":\"en\",\"userCountryCode\":\"US\",\"userConfig\":{\"userType\":\"USER_TYPE_LEGIT_USER\"}}&token=APP6_UEAAAAAZFrKr2JTvMAnz9Qbx54FHyXUTTwM24Ag";

echo $url;

$cookie = '__utmc=10102256; __utma=10102256.2123593990.1683580441.1683580445.1683584227.2; __utmz=10102256.1683584227.2.2.utmcsr=trends.google.com|utmccn=(referral)|utmcmd=referral|utmcct=/; __utmt=1; __utmb=10102256.4.9.1683584229774; __gsas=ID=239a03ee6cf8feb3:T=1683009423:S=ALNI_MaG1kGHvSuf6wo9ypv7G1_HrQWgjw; SID=WAi46U50tpxEKsf9ePSQLy4mgkNi4sgz-pbTVwgMbkdT_s5-B-H8mA0HFARNWdnH55Jv9g.; __Secure-1PSID=WAi46U50tpxEKsf9ePSQLy4mgkNi4sgz-pbTVwgMbkdT_s5-6p0cNUO3f6b-cuohxkw2VA.; __Secure-3PSID=WAi46U50tpxEKsf9ePSQLy4mgkNi4sgz-pbTVwgMbkdT_s5-S9ca5zV5Fm84PK4AkCPm6w.; HSID=AwqH99DtJ5VMHntrv; SSID=AVc19Hn6l0GddBrwU; APISID=qvSEQ3nOpLeB404R/A5Uiq3ZY8C6iplTy4; SAPISID=WncSxfUNs7jP2Uaf/AJyU2HIPY26Eu0MeN; __Secure-1PAPISID=WncSxfUNs7jP2Uaf/AJyU2HIPY26Eu0MeN; __Secure-3PAPISID=WncSxfUNs7jP2Uaf/AJyU2HIPY26Eu0MeN; AEC=AUEFqZdEa6ohX_ElUWnSN9Jeo5HEF1si0hW0vh_C1iv2ABo9JxJ6dK0jIQ; NID=511=HzuZJh0pzK7aFPqDcH6l-qWBOsG6ofLGBq-ecUBEzgRKbDY0qISpLuVwVB9OBUe8mdB01RnT3oXHkTIA-wUivmzPRx-prLqO7BOioSmnnQsQ6pn3LB80uh1QY7A_wyiFIRXMpR2DEY3tK3tcabsfACQSM2PD_kdn4-bugNFB57aRZpfucSzpKmgCvdV40yP_ht2O4d-DiHrYJ1JCMegxThqvmskNGuEg9VPKJWImRh9Y6eeSZC9J5Gonmwr-vYGCSfuXUYZKZbiCCX_bZYCU4EPF1xEhFWNs7EBNZzvsoH_B3EkDVxAHuQ; _gid=GA1.3.1475999615.1683580441; OTZ=7021274_84_88_104280_84_446940; 1P_JAR=2023-05-08-22; _gat_gtag_UA_4401283=1; _ga=GA1.3.2123593990.1683580441; _ga_VWZPXDNJJB=GS1.1.1683584223.2.1.1683584244.0.0.0; SIDCC=AP8dLtzRYvBdfGiCvwC2IK8YhX9plFj5VJuERfyu2LRje48HfZe7uiiOXy4cHNYV6UvDEjBD9OIW; __Secure-1PSIDCC=AP8dLtwtR0h-vKouvSQy66X9JqspTPtdspjYYB3wGe6mO_WVO0DUZuDFBF6gDmX-Qh4iJNR2dz90; __Secure-3PSIDCC=AP8dLtzefVOOqX1S_2VXFVIoHENRI9COF63zj9mjwtiE0l8vbP8n9WftdZeyv4GlKEAmpeMLxtE';

$headers = array(
  "accept: application/json, text/plain, */*",
  "accept-encoding: gzip, deflate, br",
  "accept-language: en-US,en;q=0.9",
  "cache-control: no-cache",
  "pragma: no-cache",
  "referer: https://trends.google.com/trends/explore?date=today%201-m&geo=US&q=Apple&hl=en",
  "sec-ch-ua: \"Chromium\";v=\"112\", \"Google Chrome\";v=\"112\", \"Not:A-Brand\";v=\"99\"",
  "sec-ch-ua-arch: \"x86\"",
  "sec-ch-ua-bitness: \"64\"",
  "sec-ch-ua-full-version: \"112.0.5615.139\"",
  "sec-ch-ua-full-version-list: \"Chromium\";v=\"112.0.5615.139\", \"Google Chrome\";v=\"112.0.5615.139\", \"Not:A-Brand\";v=\"99.0.0.0\"",
  "sec-ch-ua-mobile: ?0",
  "sec-ch-ua-model: \"\"",
  "sec-ch-ua-platform: \"Windows\"",
  "sec-ch-ua-platform-version: \"10.0.0\"",
  "sec-ch-ua-wow64: ?0",
  "sec-fetch-dest: empty",
  "sec-fetch-mode: cors",
  "sec-fetch-site: same-origin",
  "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36",
  "x-client-data: CIu2yQEIorbJAQjBtskBCKmdygEIhv/KAQiWocsBCIurzAEI7Z7NAQiFoM0BCJ+kzQEIvKXNAQjWps0BCN2mzQEIkarNAQilqs0BCM2rzQEI0K7NARjY7MwB"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$responseContent = gzdecode($result);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close($ch);

$data = substr($responseContent, 5);  // remove the prefix

echo $data;
?>
