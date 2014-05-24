<!DOCTYPE html>
<html>
<head>
<title>Facebook Logple</title>
<meta charset="UTF-8">
</head>
<body>

<!-- Add Facebook Friend Selector CSS -->

<link type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.friend.selector-1.2.1.css" rel="stylesheet" />

<!-- Add jQuery library -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

<!-- Add Facebook Friend Selector JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.friend.selector-1.2.1.js"></script>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      connected();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '507057486088314',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function connected() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '! ' + FB.getAuthResponse()['userID'];
        getFriends();
    });
  }

  function getFriends() {  
    console.log("hello");

    var access_token = FB.getAuthResponse()['accessToken'];
    var searchString = "Daniel";
    //console.log(access_token);

    var $ul = $("#friendlist"),
            $input = searchString,
            value = searchString,
            html = "";
        $ul.html("");
    
    $.ajax({
                url: "https://graph.facebook.com/me/friends?access_token="+ access_token +"&callback=?",
                dataType: 'jsonp',
                error: function (parameters) {
                    console.error("error");
                },

                success: function (parameters) {
                    console.log("success");
                    var idx = 0;
                    $.each(parameters.data, function (i, val) {
                        if((val.name.toLowerCase().indexOf(searchString.toLowerCase()) === 0 || val.name.toLowerCase().indexOf(searchString.toLowerCase()) === val.name.indexOf(" ") + 1) && idx < 5){
                            html += "<li style='height: 3.3em'> <a href=#><img src='https://graph.facebook.com/"+val.id+"/picture?type=square' />" + (val.name ? val.id + " " + val.name : "") + "</a></li>";
                            idx++;
                        }
                        console-log("bajs")
                    });

                    $ul.html(html);
                    $ul.trigger("updatelayout");
                }
            });

    // Get friends using the app
    /*FB.api('/fql', {q: 'SELECT uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) ORDER BY name ASC'}, function(response) {
        for (i=0; i < response.data.length; i++) {
          console.log("hello");
            // Put the friend's profile picture and name into a list element
            $('#friendlist').append("<li><a href='#'>" + "<img src='https://graph.facebook.com/"+response.data[i].uid+"/picture?type=square' /> " + response.data[i].name + "</a></li>");
        }
    });*/
  }

</script>



<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email,user_friends" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

<div id="friendlist">
</div>



<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".bt-fs-dialog").fSelector({
      getStoredFriends: [518640274, 529053659],
      onSubmit: function(response){
        alert(response);
      }
    });
  });
</script>

<a href="javascript:{}" class="bt-fs-dialog">Choose friends</a>

</body>
</html>