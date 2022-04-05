<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Wilio Survey, Quotation, Review and Register form Wizard by Ansonika.">
    <meta name="author" content="Ansonika">
    <title>Wilio | Survey, Quotation, Review and Register form Wizard</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="/wilio_assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/wilio_assets/css/menu.css" rel="stylesheet">
    <link href="/wilio_assets/css/style.css" rel="stylesheet">
	<link href="/wilio_assets/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="/wilio_assets/css/custom.css" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="/wilio_assets/js/modernizr.js"></script>

</head>
<style>
    .content-left-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    height: 100%;
    min-height: 100%;
    padding: 60px 90px 35px 90px;
    background-color: #28a745;
    background: none;
    color: #fff;
    text-align: center;
    position: relative;
}
    </style>

<script>
        function setPassword() {
            var last_name = document.getElementById('last_name').value;
            var mobile = document.getElementById('mobile').value;
            var last_4_mobile = mobile.slice(-4);
            var password = last_name.toUpperCase() + last_4_mobile;
            document.getElementById('password').value = password;
            document.getElementById('password-confirm').value = password;
        }

        function setName() {
            var last_name = document.getElementById('last_name').value;
            var first_name = document.getElementById('first_name').value;
            var middle_initial = document.getElementById('middle_initial').value;

            document.getElementById('name').value = first_name + " " + middle_initial + " " + last_name;
        }

    </script>
<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
	
	<nav>
		<ul class="cd-primary-nav">
			<li><a href="index.html" class="animated_link">Home</a></li>
		
		</ul>
	</nav>
	<!-- /menu -->
	
	<div class="container-fluid full-height">
		<div class="row row-height">
			<div class="col-lg-6 content-left">
				<div class="content-left-wrapper">
					<a href="index.html" id="logo"><img src="img/logo.png" alt="" width="49" height="35"></a>
					
					<!-- /social -->
					<div>
						<h2>Agrisell registration form</h2>
						<a href="#start" class="btn_1 rounded mobile_btn">Start Now!</a>
					</div>
					<div class="copy">© 2021 Agrisell</div>
				</div>
				<!-- /content-left-wrapper -->
			</div>
			<!-- /content-left -->

			<div class="col-lg-6 content-right" id="start">
				<div id="wizard_container">
					<div id="top-wizard">
							<div id="progressbar"></div>
						</div>
						<!-- /top-wizard -->
						<form id="wrapped"  method="POST" action="{{ route('register') }}"
                      enctype="multipart/form-data">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
									<h3 class="main_question"><strong>1/5</strong>Please fill with your details</h3>
									<div class="form-group">
										<input type="text" name="first_name" class="form-control required" placeholder="First Name">
									</div>
									<div class="form-group">
										<input type="text" name="last_name" class="form-control required" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input type="email" name="email" class="form-control required" placeholder="Your Email">
									</div>
                                    <div class="form-group">
										<input type="mobile" name="text" class="form-control required" placeholder="Your mobile number">
									</div>
									<div class="form-group">
										<div class="styled-select clearfix">
											<select class="wide required" name="country">
												<option value="">Your Country</option>
												<option value="Europe">Europe</option>
												<option value="Asia">Asia</option>
												<option value="North America">North America</option>
												<option value="South America">South America</option>
												<option value="Oceania">Oceania</option>                             
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<div class="form-group">
												<input type="text" name="age" class="form-control" placeholder="Age">
											</div>
										</div>
										<div class="col-9">
											<div class="form-group radio_input">
												<label class="container_radio">Male
													<input type="radio" name="gender" value="Male" class="required">
													<span class="checkmark"></span>
												</label>
												<label class="container_radio">Female
													<input type="radio" name="gender" value="Female" class="required">
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
									</div>
									<!-- /row -->
									<div class="form-group terms">
										<label class="container_check">Please accept our <a href="#" data-toggle="modal" data-target="#terms-txt">Terms and conditions</a>
											<input type="checkbox" name="terms" value="Yes" class="required">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>2/5</strong>How do rate your overall satisfaction about the service provided?</h3>
									<div class="form-group">
										<label class="container_radio version_2">Not Satisfied
											<input type="radio" name="question_1" value="Not Satisfied" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">Quite Satisfied
											<input type="radio" name="question_1" value="Quite Satisfied" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">Satisfied
											<input type="radio" name="question_1" value="Satisfied" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">Completely Satisfied
											<input type="radio" name="question_1" value="Completely Satisfied" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>

									<div class="form-group">
										<label class="container_radio version_2">Extremely Satisfied
											<input type="radio" name="question_1" value="Extremely Satisfied" class="required" onchange="getVals(this, 'question_1');">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>3/5</strong>How did you hear about our company?</h3>
									<div class="form-group">
										<label class="container_check version_2">Google Search Engine
											<input type="checkbox" name="question_2[]" value="Google Search Engine" class="required" onchange="getVals(this, 'question_2');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">A friend of mine
											<input type="checkbox" name="question_2[]" value="A friend of mine" class="required" onchange="getVals(this, 'question_2');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Print Advertise
											<input type="checkbox" name="question_2[]" value="Print Advertise" class="required" onchange="getVals(this, 'question_2');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Newspaper
											<input type="checkbox" name="question_2[]" value="Newspaper" class="required" onchange="getVals(this, 'question_2');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_check version_2">Other
											<input type="checkbox" name="question_2[]" value="Other" class="required" onchange="getVals(this, 'question_2');">
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<!-- /step-->
								<div class="step">
									<h3 class="main_question"><strong>4/5</strong>Do you think to suggest our company to a friend or parent?</h3>
									<div class="form-group">
										<label class="container_radio version_2">No
											<input type="radio" name="question_3" value="No" class="required" onchange="getVals(this, 'question_3');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">Maybe
											<input type="radio" name="question_3" value="Maybe" class="required" onchange="getVals(this, 'question_3');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">Probably
											<input type="radio" name="question_3" value="Probably" class="required" onchange="getVals(this, 'question_3');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="container_radio version_2">100% Sure
											<input type="radio" name="question_3" value="100% Sure" class="required" onchange="getVals(this, 'question_3');">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="form-group">
										<label>In no, please describe with few words why</label>
										<textarea name="additional_message" class="form-control" style="height:100px;" placeholder="Type here additional info..." onkeyup="getVals(this, 'additional_message');"></textarea>
									</div>
								</div>
								<!-- /step-->
								<div class="submit step">
									<h3 class="main_question"><strong>5/5</strong>Summary</h3>
									<div class="summary">
										<ul>
											<li><strong>1</strong>
												<h5>How do rate your overall satisfaction about the service provided?</h5>
												<p id="question_1"></p>
											</li>
											<li><strong>2</strong>
												<h5>How did you hear about our company?</h5>
												<p id="question_2"></p>
											</li>
											<li><strong>3</strong>
												<h5>Do you think to suggest our company to a friend or parent?</h5>
												<p id="question_3"></p>
												<p id="additional_message"></p>
											</li>
										</ul>
									</div>
								</div>
								<!-- /step-->
							</div>
							<!-- /middle-wizard -->
							<div id="bottom-wizard">
								<button type="button" name="backward" class="backward">Prev</button>
								<button type="button" name="forward" class="forward">Next</button>
								<button type="submit" name="process" class="submit">Submit</button>
							</div>
							<!-- /bottom-wizard -->
						</form>
					</div>
					<!-- /Wizard container -->
			</div>
			<!-- /content-right-->
		</div>
		<!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
	<!-- /menu button -->
	
	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<!-- COMMON SCRIPTS -->
	<script src="/wilio_assets/js/jquery-3.2.1.min.js"></script>
    <script src="/wilio_assets/js/common_scripts.min.js"></script>
	<script src="/wilio_assets/js/velocity.min.js"></script>
	<script src="/wilio_assets/js/functions.js"></script>

	<!-- Wizard script -->
	<script src="/wilio_assets/js/survey_func.js"></script>

</body>
</html>