<?php

use yogesh\LinkedIn;

require_once "LinkedIn.php";

$app_id = "";
$app_secret = "";
$callback = "http://localhost/linkedin_callback.php";
$scopes = "r_emailaddress r_liteprofile";
$ssl = false; //TRUE FOR PRODUCTION ENV.

$linkedin = new LinkedIn($app_id, $app_secret, $callback, $scopes, $ssl);