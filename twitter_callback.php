<?php 
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Biscuit</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
    ini_set('display_errors', 1);
    require("twitteroauth/autoload.php");
    require_once('TwitterAPIExchange.php');
    use Abraham\TwitterOAuth\TwitterOAuth;
    echo 'callback';
    $config = require_once 'config.php';

    $oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');

    if (empty($oauth_verifier) ||
      empty($_SESSION['oauth_token']) ||
      empty($_SESSION['oauth_token_secret'])
    ) {
      // something's missing, go and login again
      header('Location: ' . $config['url_login']);
    }

    // connect with application token
    $connection = new TwitterOAuth(
      $config['consumer_key'],
      $config['consumer_secret'],
      $_SESSION['oauth_token'],
      $_SESSION['oauth_token_secret']
    );

    // request user token
    $token = $connection->oauth(
      'oauth/access_token', [
          'oauth_verifier' => $oauth_verifier
      ]
    );

    $twitter = new TwitterOAuth(
      $config['consumer_key'],
      $config['consumer_secret'],
      $token['oauth_token'],
      $token['oauth_token_secret']
    );

    ?> <pre> <?php
    // var_dump($twitter);
    echo $oauth_verifier;
    ?> </pre> <?php

    /** Perform a GET request and echo the response **/
    /** Note: Set the GET field BEFORE calling buildOauth(); **/
    $url = 'https://api.twitter.com/1.1/statuses/home_timeline.json?count=25&exclude_replies=true';
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $data=$twitter->buildOauth($url, $requestMethod)
                 ->performRequest();

    // Use this to look at the raw JSON
    ?> <pre> <?php
    // echo($data);
    ?> </pre> <?php

    // Read the JSON into a PHP object
    $phpdata = json_decode($data, true);

    // Debug - check the PHP object
    ?>
    <pre>
      <?php
      // var_dump($phpdata);
      var_dump($_SESSION);
      ?>
    </pre>
    <main role="main" class="content_wrapper">
    <?php
    foreach ($phpdata as $status){
        $screen_name = $status["user"]["screen_name"];
        $name = $status["user"]["name"];
        $tweet = $status["text"];
        $time = date("H:i", strtotime($status["created_at"]));
        $profileimage = $status["user"]["profile_image_url"];

      ?> -->
      <div class="tweet_box">
        <div class="inner">
          <p>
            <a href="http://www.twitter.com/<?php echo $screen_name; ?>" target="_blank">
              <img src="<?php echo $profileimage; ?>" alt="<?php echo $name; ?>'s Profile Image">
              <?php echo $name; ?>
              <span class="sub">@<?php echo $screen_name . " at " . $time; ?></span>
            </a>
          </p>
          <p class="tweet"> <?php echo $tweet;?> </p>
        </div>
      </div>
      <?php
      }
      //Loop through the status updates and print out the text of each
      // foreach ($phpdata["statuses"] as $status){
      //   $screen_name = $status["user"]["screen_name"];
      //   $name = $status["user"]["name"];
      //   $tweet = $status["text"];
      //   $time = date("H:i", strtotime($status["created_at"]));
      //   $profileimage = $status["user"]["profile_image_url"];

      ?> -->
      <!-- <div class="tweet_box">
        <div class="inner">
          <p>
            <a href="http://www.twitter.com/<?php echo $screen_name; ?>" target="_blank">
              <img src="<?php echo $profileimage; ?>" alt="<?php echo $name; ?>'s Profile Image">
              <?php echo $name; ?>
              <span class="sub">@<?php echo $screen_name . " at " . $time; ?></span>
            </a>
          </p>
          <p class="tweet"> <?php echo $tweet;?> </p>
        </div>
      </div> -->
      <?php
      // }
      ?>
    </main>
  </body>
</html>
