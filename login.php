<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
	<title></title>
	<meta name="description" content="" />
  	<meta name="keywords" content="" />
	<meta name="robots" content="" />

<!-- jquery and google scripts -->
	<link rel="stylesheet" href="style.css" />
	<script src="https://apis.google.com/js/client:platform.js" async defer>
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script>
	var user_id;
	var name;
	var image;
	var profile;
	var i=1;	
	function signinCallback(authResult) {
		if (i==1) {
			if (authResult['status']['signed_in']) {
				 gapi.client.load('plus','v1', function(){
				 	var request = gapi.client.plus.people.get({'userId': 'me'});
			 		request.execute(function(resp) {
						user_id = resp.id;
						name = resp.displayName;
						image = resp.image.url;
						profile = resp.url;
					});
		
				});
			}
		}
		else {
			ref = "<? echo $_SERVER['HTTP_REFERER']; ?>";
			$.ajax({
				type: "POST",
				url: "set_session.php",
				dataType: "html",
				data: {user_id: user_id, name: name, image: image, profile: profile, ref: ref},
				success: function(phpfile) { 
				  $("#temp").html(phpfile);	
				}
			});
		}
		i++;
	}
	
		
	</script>
</head>
<body>
	<div id="loginWindow">
		<p>
			Please use the button below to authorize google for authentication.
		</p>
		<span id="signinButton">
  <span
    class="g-signin"
    data-callback="signinCallback"
    data-clientid="760640768316-6s9gm9l89gu99nb5bif6hhfp0dup2kv2.apps.googleusercontent.com"
    data-cookiepolicy="single_host_origin"
    data-requestvisibleactions="http://schema.org/AddAction"
    data-scope="https://www.googleapis.com/auth/plus.login">
  </span>
</span>
	</div>
	<div id="temp"></div>
</body>
</html>