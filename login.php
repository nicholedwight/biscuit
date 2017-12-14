<?php
  ini_set('display_errors', 1);
  require_once('config.php');
  require('twitteroauth/autoload.php');
  use Abraham\TwitterOAuth\TwitterOAuth;
  session_start();

  $connection = new TwitterOAuth($_ENV["CONSUMER_KEY"], $_ENV["CONSUMER_SECRET"]);
  $request_token = $connection->oauth(
    'oauth/request_token', [
      'oauth_callback' => $_ENV["OAUTH_CALLBACK"]
    ]
  );
  
  $_SESSION['oauth_token'] = $request_token['oauth_token'];
  $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
  $url = $connection->url(
    'oauth/authorize', [
      'oauth_token' => $request_token['oauth_token']
    ]
  );
?>

<a href="<?php echo $url ?>">Login</a>