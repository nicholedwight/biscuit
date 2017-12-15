<?php session_start();
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');
$config = require_once 'config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Biscuit</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
    if (!isset($_SESSION)) { ?>
    <a href="login.php">Login</a>
    <?php 
    } 
    echo "<pre>";
    var_dump($_SESSION); 
    ?>
    </pre>
    <?php 
    $url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $data=$twitter->buildOauth($url, $requestMethod)
                 ->performRequest();

    // Use this to look at the raw JSON
    ?> <pre> <?php
    echo($data);
    ?> </pre> <?php

    // Read the JSON into a PHP object
    $phpdata = json_decode($data, true);

    // Debug - check the PHP object
    ?>
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
      ?>
  </body>
</html>
