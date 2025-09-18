<?php
session_start();
include("functions.php");
if(isset($_GET['page']))
	$page=$_GET['page']; 
else
	$page="home";	//initial load, default page value
?>
<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

    <!--- basic page needs
   ================================================== -->
    <meta charset="utf-8">
    <title>Darius' Website - <?php echo ucfirst($page);?> Page</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
   ================================================== -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/main.css">
	<link href="assets/css/darius-main.css" rel="stylesheet" />

    <!-- script
   ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <!-- favicons
	================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <!-- header 
   ================================================== -->
   <header id="header" class="row">   

   		<div class="header-logo">
	        <a href="index.php">Darius' Website</a>
	    </div>

	   	<nav id="header-nav-wrap">
			<ul class="header-main-nav">
				<?php
				include("navigation.php");
				?>
			</ul>
		</nav>

		<!--<a class="header-menu-toggle" href="#"><span>Menu</span></a>    -->	
   	
   </header> <!-- /header -->


   <!-- home
   ================================================== -->
   <section id="home" data-parallax="scroll" data-image-src="assets/images/hero-bg.jpg" data-natural-width=3000 data-natural-height=2000>

        <div class="overlay"></div>
        <div class="home-content">        

            <div class="row contents">                     
                <div class="home-content-left">

                    <h3 data-aos="fade-up">Welcome to Darius' Website</h3>

                    <h1 data-aos="fade-up">
                        I Am Darius! <br>
                        This Is My Website. <br>
                        Come Learn About Me.
                    </h1>
                </div>
            </div>

        </div> <!-- end home-content -->

        <ul class="home-social-list">
            <li>
                <a href=https://www.linkedin.com/in/darius-chavez-161436264/ target="_blank"><i class="fa fa-linkedin"></i></a>
            </li>
            <li>
                <a href=https://github.com/Darcha01 target="_blank"><i class="fa fa-github"></i></a>
            </li>
        </ul>
        <!-- end home-social-list -->

        <div class="home-scrolldown">
            <a href="#school" class="scroll-icon smoothscroll">
                <span>Scroll Down</span>
                <i class="icon-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </section> <!-- end home --> 
	
	<!-- About me
    ================================================== -->
	<section id="school">
		<!-- NOT ACTUALLY THE SCHOOL SECTION, JUST USING THE FORMAT FROM THE SCHOOL SECTION-->	
		<?php 
		switch($page){
			case "work":
				include("work.php");
				break;
			case "school":
				include("school.php");
				break;
			case "hobbies":
				include("hobbies.php");
				break;
			case "contact":
				include("contact.php");
				break;
			case "results":
				include("results.php");
				break;
			case "login":
				include("login.php");
				break;
			case "register":
				include("register.php");
				break;
			default:
				include("home.php");
		}
		?>
	</section> <!-- end About me -->
	
    <div id="preloader"> 
    	<div id="loader"></div>
    </div>  

    <!-- Java Script
    ================================================== -->
    <script src="assets/js/jquery-2.1.3.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
