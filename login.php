<?php

// TODO change these to your API key and secret
define("API_CONSUMER_KEY", "j18qrld132fh");
define("API_CONSUMER_SECRET", "brNqI3MlrdTw37lY");

include("helpers.php");

// create a new instance of the OAuth PECL extension class
$oauth = new OAuth(API_CONSUMER_KEY, API_CONSUMER_SECRET);

$oauth->enableDebug();

if( file_exists(".service.dat") ) {
  $config = json_decode(file_get_contents(".service.dat"));
  if( isset($config->oauth_token) && isset($config->oauth_token_secret) ) {
    $oauth->setToken($config->oauth_token, $config->oauth_token_secret);
  } else {
    print_line("We had a service.dat file, but it didn't contain a token/secret?", null, STDERR, __LINE__);
  }
} else {
  print("We don't have a service.dat file, so we need to get access tokens!");

  $request_token_info = $oauth->getRequestToken("https://api.linkedin.com/uas/oauth/requestToken");
  if( $request_token_info === FALSE || empty($request_token_info) ) {
    print_line("Failed to fetch request token, debug info: %s", print_r($oauth->debugInfo, true), STDERR, __LINE__);
  }

  $oauth->setToken($request_token_info["oauth_token"], $request_token_info["oauth_token_secret"]);

  print_line("Please visit this URL:
		\nhttps://www.linkedin.com/uas/oauth/authenticate?oauth_token=%s
		\nIn your browser and then input the numerical code you are provided here: ", $request_token_info["oauth_token"]);

  $pin = trim(fgets(STDIN));

  $access_token_info = $oauth->getAccessToken("https://api.linkedin.com/uas/oauth/accessToken", "", $pin);
  if( $access_token_info === FALSE || empty($access_token_info) ) {
    print("Failed to fetch access token, debug info:");
    die(print_r($oauth->debugInfo, true));
  }

  $oauth->setToken($access_token_info["oauth_token"], $access_token_info["oauth_token_secret"]);

  file_put_contents(".service.dat", json_encode($access_token_info));
}

// do a simple query to make sure our token works
// we fetch our own profile on linkedin. This query will be explained more on later pages
$api_url = "http://api.linkedin.com/v1/people/~";
$oauth->fetch($api_url, null, OAUTH_HTTP_METHOD_GET);

// print_response is just a fancy wrapper around print and is defined later
// or you can look now and see it in the code download
print_response($oauth);

print_line("\n********A basic user profile call********");
$api_url = "http://api.linkedin.com/v1/people/~:(first-name,last-name,positions)";
$oauth->fetch($api_url, null, OAUTH_HTTP_METHOD_GET);
// JSON
// $oauth->fetch($api_url, null, OAUTH_HTTP_METHOD_GET, array('x-li-format' => 'json'));
$response = $oauth->getLastResponse(); // just a sample of how you would get the response
print_response($oauth);