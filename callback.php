<?php
  ini_set('display_errors', 1);
  require_once('config.php');
  require('twitteroauth/autoload.php');
  use Abraham\TwitterOAuth\TwitterOAuth;
  session_start();

  $request_token = [];
  $request_token['oauth_token'] = $_SESSION['oauth_token'];
  $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

  if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
      // Abort! Something is wrong.
      print 'woops';
  }

  $connection = new TwitterOAuth($_ENV["CONSUMER_KEY"], $_ENV["CONSUMER_SECRET"], $request_token['oauth_token'], $request_token['oauth_token_secret']);

  $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
  $access_token = $_SESSION['access_token'];
  $_SESSION['access_token'] = $access_token;
  $connection = new TwitterOAuth($_ENV["CONSUMER_KEY"], $_ENV["CONSUMER_SECRET"], $access_token['oauth_token'], $access_token['oauth_token_secret']);

  $user = $connection->get("account/verify_credentials");
  $_SESSION['profile_image_url'] = $user->profile_image_url;
  $userid = $_SESSION['access_token']['user_id'];
  $username = $_SESSION['access_token']['screen_name'];
  $profile_image_url = $_SESSION['profile_image_url'];
  $url = "http://localhost:8888/biscuit/index.php";

  header('Location: '. $url);