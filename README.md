# PHP LinkedIn and GOogle Login Example

Simple PHP LinkedIn and Google Login Example OAuth 2.

## Getting Started
1) Index.php

Add two buttons for login.
You have to add your google client key.
```
<!DOCTYPE html>
<html>

<head>
        
<meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content=""><!-- ADD YOUR GOOGLE KEY -->
 <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     <script src="https://apis.google.com/js/platform.js" async defer></script>
    <title>Login</title>
      <script>
         $(function () {
           $('[data-toggle="tooltip"]').tooltip()
         })
      </script>
    <script type="text/javascript">

      var googleUser = {};
      var startApp = function() {
        gapi.load('auth2', function(){
          // Retrieve the singleton for the GoogleAuth library and set up the client.
          auth2 = gapi.auth2.init({
            client_id: '', //Add Your Client Key
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
          });
          attachSignin(document.getElementById('customBtn'));
        });
      };
      function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {
                  console.log("googleUser",googleUser.getBasicProfile().getId());
                  var profile = googleUser.getBasicProfile();
      $.post("/google_login_data.php", {token: profile.getId(), name: profile.getName(), image: profile.getImageUrl(), email:  profile.getEmail()}, function(data) {
        window.location.href="http://localhost/dashboard.php";
                   } ); 
                    return false;
               
            }, function(error) {
              //alert(JSON.stringify(error, undefined, 2));
            });
      }


    </script>
</head>
<style type="text/css">
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css);
    @import url(http://fonts.googleapis.com/css?family=Titillium+Web&subset=latin,latin-ext);
    @media (min-width: 768px) {
     .kpx_row-sm-offset-3 div:first-child[class*="col-"] {
         margin-left: 25%;
     }
    }
    body {
     font-family: 'Titillium Web', sans-serif; 
    }
    a{
     color:#ff5400;
    }
    a:hover {
     opacity: 0.8;
     color:#ff5400;
     text-decoration:none;
    }
    .kpx_login .kpx_authTitle {
     text-align: center;
     line-height: 300%;
    }
     
    .kpx_login .kpx_socialButtons a {
     color: white; // In yourUse @body-bg 
    opacity:0.9;
    }
    .kpx_login .kpx_socialButtons a:hover {
     color: white;
    opacity:1;     
    }
    
    .kpx_login .kpx_socialButtons .kpx_btn-facebook {background: #3b5998; -webkit-transition: all 0.5s ease-in-out;
      -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
           transition: all 0.5s ease-in-out;}
    .kpx_login .kpx_socialButtons .kpx_btn-facebook:hover {background: #172d5e}
    .kpx_login .kpx_socialButtons .kpx_btn-facebook:focus {background: #fff; color:#3b5998; border-color: #3b5998;}
    
    .kpx_login .kpx_socialButtons .kpx_btn-google-plus {background: #c32f10; -webkit-transition: all 0.5s ease-in-out;
      -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
           transition: all 0.5s ease-in-out;}
    .kpx_login .kpx_socialButtons .kpx_btn-google-plus:hover {background: #6b1301}
    .kpx_login .kpx_socialButtons .kpx_btn-google-plus:focus {background: #fff; color: #c32f10; border-color: #c32f10}
    
    
    .kpx_login .kpx_socialButtons .kpx_btn-linkedin {background: #0976b4; -webkit-transition: all 0.5s ease-in-out;
      -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
           transition: all 0.5s ease-in-out;}
    .kpx_login .kpx_socialButtons .kpx_btn-linkedin:hover {background: #004269}
    .kpx_login .kpx_socialButtons .kpx_btn-linkedin:focus {background: #fff; color: #0976b4; border-color: #0976b4}
</style>



<body>
     <div class="container">
        <div class="kpx_login">
            <h3 class="kpx_authTitle">Login or
                <a href="#">Sign up</a>
            </h3>
            <div class="row kpx_row-sm-offset-3 kpx_socialButtons">
                <!--           <div class="col-xs-2 col-sm-2"><a href="#" class="btn btn-lg btn-block kpx_btn-facebook" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-2x"></i><span class="hidden-xs"></span></a></div> -->
                <div class="col-xs-3 col-sm-3">
                    <a href="init_linkedin_login.php" class="btn btn-lg btn-block kpx_btn-linkedin" data-toggle="tooltip" data-placement="top" title="LinkedIn">
                     <i class="fa fa-linkedin fa-2x"></i>
                     <span class="hidden-xs"></span>
                  </a>
                </div>
               <div id="customBtn" onClick="onSignIn" class="col-xs-3 col-sm-3">
                  <a href="#" class="btn btn-lg btn-block kpx_btn-google-plus" data-toggle="tooltip" data-placement="top" title="Google Plus">
                  <i class="fa fa-google-plus fa-2x"></i>
                  <span class="hidden-xs"></span>
                  </a>
               </div>
            </div>
        </div>
        </div>
</body>
<script>startApp();</script>
</html>
```


2) init_linkedin_login.php

Linkedin login configurations.


```
<?php
// Change these
define('API_KEY', '');//Your API key
define('API_SECRET', '');//Your Secret Key
define('REDIRECT_URI', ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")?'https':'http').'://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);
define('SCOPE',        'r_liteprofile r_emailaddress'                        );

session_name('linkedin');
session_start();


// OAuth 2 Control Flow
if (isset($_GET['error'])) {
    // LinkedIn returned an error
    print $_GET['error'] . ': ' . $_GET['error_description'];
    exit;
} elseif (isset($_GET['code'])) {
    // User authorized your application
    if ($_SESSION['state'] == $_GET['state']) {
        // Get token so you can make API calls
        getAccessToken();
    } else {

        // CSRF attack? Or did you mix up your states?
        exit;
    }
} else { 
    if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
        // Token has expired, clear the state
        $_SESSION = array();
    }
    if (empty($_SESSION['access_token'])) {
        // Start authorization process
        getAuthorizationCode();
    }
}

$user = fetch('GET');

var_dump($user);die;
 
function getAuthorizationCode() {
    $params = array('response_type' => 'code',
                    'client_id' => API_KEY,
                    'scope' => SCOPE,
                    'state' => uniqid('', true), // unique long string
                    'redirect_uri' => REDIRECT_URI,
              );
 
    // Authentication request
    $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
 
    // Needed to identify request when it returns to us
    $_SESSION['state'] = $params['state'];
 
    // Redirect user to authenticate
    header("Location: $url");
    exit;
}
 
function getAccessToken() {
    $params = array('grant_type' => 'authorization_code',
                    'client_id' => API_KEY,
                    'client_secret' => API_SECRET,
                    'code' => $_GET['code'],
                    'redirect_uri' => REDIRECT_URI,
              );
 
    // Access Token request
    $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
 
    // Tell streams to make a POST request
    $context = stream_context_create(
                    array('http' => 
                        array('method' => 'POST',
                        )
                    )
                );
 
    // Retrieve access token information
    $response = file_get_contents($url, false, $context);
    // Native PHP object, please
    $token = json_decode($response);
 
    // Store access token and expiration time
    $_SESSION['access_token'] = $token->access_token; // guard this! 
    $_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
    $_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time
    return true;
}
 
function fetch($method, $body = '') {
$params = array('oauth2_access_token' => $_SESSION['access_token'],
                    'format' => 'json',
        );
 

    $context = stream_context_create(
                    array('http' => 
                        array('method' => $method,
                        )
                    )
                );
    //get EMail
    $getEmailData = 'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))&oauth2_access_token='. $_SESSION['access_token'];
    $response = file_get_contents( $getEmailData, false, $context);
    $email = json_decode($response)->elements[0]->{"handle~"}->emailAddress;
    //printf($email);
    //get first name and last name.
    $getNameData = 'https://api.linkedin.com/v2/me?oauth2_access_token=' . $_SESSION['access_token'];
    $nameResponse = file_get_contents($getNameData, false, $context);
    $userName =  json_decode($nameResponse, true);
    //echo 'f_name = '.$userName['firstName'];
$first_name = $userName['localizedFirstName'];
$last_name=$userName['localizedLastName'];
$image = '';
$mobile = '';
$id= $userName['id'];
$_SESSION['email']  = $email;
header("Location:http://localhost/dashboard.php");
    exit;


}?>
```

3) google_login_data.php
You can insert values in to the database after succesful google login and redirect to dashboard.
```
<?php
session_start();
$first_name = $_POST['name'];
$last_name='';
$email = $_POST['email'];
$image = $_POST['image'];
$mobile = '';
$id= $_POST['token'];
//save values in to the database.

$_SESSION['name']= $first_name;
$_SESSION['email']= $email;

?>
```

4) Dashboard.php
Redirect to dashboard after successful login.
```
Give an exam<?php
session_start();
echo "Name: " . $_SESSION['name'];

echo ",  Email: " .$_SESSION['email'];
?>
```

