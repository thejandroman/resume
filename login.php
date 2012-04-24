<?php

// TODO change these to your API key and secret
define("API_CONSUMER_KEY", "j18qrld132fh");
define("API_CONSUMER_SECRET", "brNqI3MlrdTw37lY");

include("helpers.php")

// create a new instance of the OAuth PECL extension class
$oauth = new OAuth(API_CONSUMER_KEY, API_CONSUMER_SECRET);

// get our request token
$api_url = "https://api.linkedin.com/uas/oauth/requestToken";
$rt_info = $oauth->getRequestToken($api_url);

// now set the token so we can get our access token
$oauth->setToken($rt_info["oauth_token"], $rt_info["oauth_token_secret"]);

// instruct on how to authorize the app
print("Please visit this URL:\n\n");
printf("https://www.linkedin.com/uas/oauth/authenticate?oauth_token=%s", $rt_info["oauth_token"]);
print("\n\nIn your browser and then input the numerical code you are provided here: ");

// ask for the pin  
$pin = trim(fgets(STDIN));

// get the access token now that we have the verifier pin
$at_info = $oauth->getAccessToken("https://api.linkedin.com/uas/oauth/accessToken", "", $pin);

// set the access token so we can make authenticated requests
$oauth->setToken($at_info["oauth_token"], $at_info["oauth_token_secret"]);

// do a simple query to make sure our token works
// we fetch our own profile on linkedin. This query will be explained more on later pages
$api_url = "http://api.linkedin.com/v1/people/~";
$oauth->fetch($api_url, null, OAUTH_HTTP_METHOD_GET);

// print_response is just a fancy wrapper around print and is defined later
// or you can look now and see it in the code download
print_response($oauth);