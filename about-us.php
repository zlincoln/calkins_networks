<!DOCTYPE HTML>
<html>
<head>
	<title>About Us | Calkins Networks</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/master.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/thirdparty/jquery.fitvids.js"></script>
	<script type="text/javascript" src="js/thirdparty/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<header>
		<nav class="navbar" role="navigation">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="index.php"><img src="images/logo-alt.png" class="img-responsive"></a>
		    </div>
		    <div class="collapse navbar-collapse" id="main-nav">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="index.php">Home</a></li>
		        <li><a href="services.php">Services</a></li>
		        <li class="active"><a href="about-us.php">About Us</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>
	<section id="interior-banner">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="page-heading">
						<h2>About Us</h2>
						<!-- <h4>Location, Contact Information, Etcetera.</h4> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="about-us">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-7">
					<p>Calkins Networks is a full-service IT firm located in Colchester, VT. We have been providing quality IT services for over ten years. Services offered include network design, remote and on-site IT support, cloud services such as complete Terminal Server hosting, application hosting, Exchange email hosting, and online backup services. Our extensive knowledge and dedication to providing the utmost customer service has kept a loyal client base that has allowed us to grow at a consistent and comfortable pace.</p>
					<p>Calkins Networks prescribes to a straightforward and honest business model. One major difference that separates Calkins Networks from its competitors is we do not require clients to sign long-term, expensive support contracts. Customers pay for service only when they need service. If we're not living up to customer's expectations, they should be permitted to seek out another IT partner.</p>
					<p>We know how important it is to find an IT partner that is dedicated to providing the service level required to operate your business. We are confident we can achieve and exceed your expectations and build a strong business relationship.</p>
					<!--
					http://kenhowardpdx.com/blog/2013/05/quick-and-easy-responsive-google-maps/
					
					https://github.com/jimmyhillis/angular-fitvids
					-->
					<div class="well info-box">
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<h5>Hours</h5>
								<p>Mon-Fri: 8am - 5pm</p>
								<h5>Phone</h5>
								<p>(802) 497-6210</p>
							</div>
							<div class="col-xs-12 col-sm-8">
								<div class="map-wrap-wrapper">
									<div class="map-wrap">
										<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2845.540471846105!2d-73.152658!3d44.50408189999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cca70afe9559413%3A0xbfa1eddba071bbf7!2s462+Hegeman+Ave!5e0!3m2!1sen!2sus!4v1397592102830" width="600" height="450" frameborder="0" style="border:0"></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-5 col-md-4 col-md-push-1">
					<?php

						$success = false;

						function spamcheck($field){
							if($field != ''){
								$field = filter_var($field, FILTER_SANITIZE_EMAIL);
								if(filter_var($field, FILTER_VALIDATE_EMAIL)){
									return true;
								}else{
									return false;
								}
							}else{
								return false;
							}
						}
						if(isset($_POST['email']) && $_POST['honeypot'] == ''){
							require("postmark.php");

							$name = isset($_POST['name']) ? $_POST['name'] : '';
							$email = isset($_POST['email']) ? $_POST['email'] : '';
							$message = isset($_POST['message']) ? $_POST['message'] : '';

							if(spamcheck($email)){

								$postmark = new Postmark("d616706e-08e8-4b02-b6a5-0a05c3431ef6", "zach@burlingtoncollective.com", $email);

								$subjectLinePart = $name != '' ? $name : 'New Lead';

								$messageFieldValue = $message != '' ? wordwrap($message, 70) : '[user didn\'t provide a message]';
								$nameFieldValue = $name != '' ? $name : '[user didn\'t provide their name]';

								$messageString = "Replying to this email will message your lead directly.\n\n";
								$messageString .= "Name: ".$nameFieldValue."\n\n";
								$messageString .= "Email: ".$email."\n\n";
								$messageString .= "Message: ".$messageFieldValue;
								$messageString .= "\n\n\nIf you are recieving spam often, contact your friendly neighborhood web developer: zach@burlingtoncollective.com";

								$result = $postmark->to('derrick@calkinsnetworks.com')
												->subject($subjectLinePart." via calkinsnetworks.com")
												->plain_message($messageString)
												->send();

								$success = true;
							}
							
						}

					?>
					<form class="form well clearfix" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<h3>Let us know how we can help</h3>
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Joe Smith">
						</div>
						<div class="form-group <?php echo isset($email) && spamcheck($email) && !$success ? 'has-error' : ''; ?>">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="example@example.com">
						</div>
						<div class="form-group">
							<label for="message">Message</label>
							<textarea rows="5" class="form-control" id="message" name="message" placeholder="Questions? Looking for a particular service?"></textarea>
						</div>
						<input type="hidden" name="honeypot">
						<input type="hidden" id="notification" name="success" value="<?php echo $success ? 'success' : ''; ?>">
						<button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p>&copy; 2014 Calkins Networks</p>
				</div>
			</div>
		</div>
	</footer>
	<div id="success-message" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Thanks for reaching out!</h4>
				</div>
				<div class="modal-body">
					<p>We'll get right back to you as soon as possible.</p>
				</div>
				<div class="modal-footer clearfix">
					<button class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			var notification = $('#notification').val();

			if(notification == 'success'){
				$('#success-message').modal('show');
			}
		})
	</script>
</body>
</html>