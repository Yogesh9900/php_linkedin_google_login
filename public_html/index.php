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