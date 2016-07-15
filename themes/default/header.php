<!DOCTYPE html>
<html lang="es">
    <head>
	
	<!-- 
        _____  _____ ____  _____  _____ _____ ____  _   _     _____ __  __  _____ 
       / ____|/ ____/ __ \|  __ \|  __ \_   _/ __ \| \ | |   / ____|  \/  |/ ____|
      | (___ | |   | |  | | |__) | |__) || || |  | |  \| |  | |    | \  / | (___  
       \___ \| |   | |  | |  _  /|  ___/ | || |  | | . ` |  | |    | |\/| |\___ \ 
       ____) | |___| |__| | | \ \| |    _| || |__| | |\  |  | |____| |  | |____) |
      |_____/ \_____\____/|_|  \_\_|   |_____\____/|_| \_|   \_____|_|  |_|_____/ 
                                                                                  
    	Dennys José Márquez Reyes                                                                              
 		email: dennysjmarquez@gmail.com
 		linkedin: https://ve.linkedin.com/in/dennysjmarquez
	
	/ -->	
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=get_config("site_description")?>">
    <meta name="author" content="">
	<meta http-equiv="Cache-Control" content="max-age=3600"> 
    <link rel="icon" href="<?php get_template_directory_uri(); ?>/favicon.ico">
    <title><?=GetTitle()?> | BlogDesk</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php get_template_directory_uri(); ?>/css/bootstrap.css" type='text/css'>
    <link rel="stylesheet" href="<?php get_template_directory_uri(); ?>/css/style.css" type="text/css">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->

    </head>

<body>

<header>

<!-- Preloader -->

<div id="preloader">

    <div id="status">

        <div class='spinner-wrap'>

            <div class='leftside'></div>

            <div class='rightside'></div>

        <div class='spinner'>

            <div class='bounce1'></div>

            <div class='bounce2'></div>

            <div class='bounce3'></div>

        </div>

        </div>

    </div>

</div> 

<!-- Fixed navbar -->

<nav class="navbar main-menu navbar-default navbar-fixed-top" role="navigation">

  <div class="container">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

              <span class="sr-only">Toggle navigation</span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

            </button>

      <a class="navbar-brand" href="#" title="logo"><img src="<?php get_template_directory_uri(); ?>/images/logo.png" alt="logo" /></a> </div>

    <div class="navbar-collapse collapse pull-left">

      <ul class="nav navbar-nav menu" id="menu">

        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Home <span class="caret"></span></a>

        	<ul class="dropdown-menu" role="menu">

            	<li><a href="index.php">Home 1</a></li>

            	<li><a href="index-2.php">Home 2</a></li>

          	</ul>

        </li>

        <li class="dropdown mega-dropdown">

			    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mega Menu <span class="caret"></span></a>

            <div class="dropdown-menu">

                <div class="container">

                    <div class="mega-dropdown-menu">

    				    <div class="tabbable tabs-left">

                            <ul class="nav nav-tabs">

                              <li class="active"><a href="#Photography" data-toggle="tab">Photography <i class="arrow_carrot-right"></i></a></li>

                              <li><a href="#Travel" data-toggle="tab">Travel <i class="arrow_carrot-right"></i></a></li>

                              <li><a href="#Music" data-toggle="tab">Music <i class="arrow_carrot-right"></i></a></li>

                              <li><a href="#Apps" data-toggle="tab">Apps <i class="arrow_carrot-right"></i></a></li>

                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane active" id="Photography">

                	                <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post1.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Travel The World</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post6.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Google Play Music</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post4.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Business Plan</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post8.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Best Mobile Apps</h3>

                                                </div>

                                            </div>

                                    </div>       

                                </div>

                                <div class="tab-pane" id="Travel">

                	                <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post5.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>LifeStyle</h3>

                                                </div>

                                            </div>

                                    </div>

                                   <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post2.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Mobile reviews</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post7.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Apple Probook</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post4.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Business Call</h3>

                                                </div>

                                            </div>

                                    </div>

                                </div>  

                                <div class="tab-pane" id="Music">

                	                <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post6.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Android Music</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post1.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Canan Digital Cam</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post3.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Classical Music</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post8.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>IPhone Tunes</h3>

                                                </div>

                                            </div>

                                    </div>

                                </div>

                                <div class="tab-pane" id="Apps">

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post1.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Android Music</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post6.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Canan Digital Cam</h3>

                                                </div>

                                            </div>

                                    </div>

                                   <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post8.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>Classical Music</h3>

                                                </div>

                                            </div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-3">

                                            <div class="thumbnail">

                                                <a href="single.php"><img src="<?php get_template_directory_uri(); ?>/images/feature-post3.png" alt="Generic placeholder thumbnail"></a>

                                                <div class="caption">

                                                    <h3>IPhone Tunes</h3>

                                                </div>

                                            </div>

                                    </div>

                                </div>

                            </div>

                        </div>   

				    </div>

                </div>

            </div>				

		</li>

        <li class="dropdown mega-dropdown">

			    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mega Menu 2<span class="caret"></span></a>				

				<div class="dropdown-menu">

                    <div class="container">

    				<div class="mega-dropdown-menu">

                        <div class="col-md-3 col-xs-12 col-sm-6 sub-menu">

                            <h3>Categories</h3>

                            <ul class="list-unstyled">

                              <li><a href="#">Photography </a></li>

                                <li><a href="#">Travel </a></li>

                                <li><a href="#">Music </a></li>

                                <li><a href="#">LifeStyle </a></li>

                                <li><a href="#">Apps </a></li>

                                <li><a href="#">Business </a></li>

                            </ul>

                        </div>

                        <div class="col-md-3 col-xs-12 col-sm-6 sub-menu">

                            <h3>Social Menu</h3>

                            <ul class="list-unstyled">

                              <li><a href="#"><i class="fa fa-facebook-square"></i> Facebook </a></li>

                                <li><a href="#"><i class="fa fa-google-plus-square"></i> Google Plus </a></li>

                                <li><a href="#"><i class="fa fa-twitter-square"></i> Twitter </a></li>

                                <li><a href="#"><i class="fa fa-pinterest-square"></i> Pinterest </a></li>

                                <li><a href="#"><i class="fa fa-linkedin-square"></i> Linkedin </a></li>

                                <li><a href="#"><i class="fa fa-tumblr-square"></i> Tumblr </a></li>

                            </ul>

                        </div>

                        <div class="col-md-3 col-sm-6 sub-menu hidden-xs">

                            <h3>Recent Post Menu</h3>

                            <ul class="list-unstyled">

                              <li><a href="single.php">Should Be A Large Heading </a></li>

                                <li><a href="single.php">Match With the Size  </a></li>

                                <li><a href="single.php">The Heading Text Size</a></li>

                                <li><a href="single.php">Lorem ipsum dolor sit </a></li>

                                <li><a href="single.php">Should Be A Large Heading </a></li>

                                <li><a href="single.php">Match With the Image  </a></li>

                            </ul>

                        </div>

                        <div class="col-md-3 col-sm-6 sub-menu  hidden-xs">

                            <h3>About Us</h3>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet lectus congue mi viverra congue in sed leo.</p>

                            <br/>

                            <ul class="list-inline store-icon">

                              <li><a href=""><i class="fa fa-android"></i> Google Play</a></li>

                              <li><a href=""><i class="fa fa-apple"></i> Apple Store</a></li>

                            </ul>

                        </div>

                    </div>

                    </div>   

				</div>				

			</li>

          <li class="dropdown">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Features <span class="caret"></span></a>

          <ul class="dropdown-menu" role="menu">

          	<li><a href="masonry-blog.php">Masonry Blog</a></li>

            <li><a href="classic-blog.php">Classic Blog</a></li>

            <li class="divider"></li>

            <li><a href="single.php">Single Post</a></li>

            <li><a href="video-blog.php">Video Post</a></li>

            <li><a href="audio-blog.php">Audio Post</a></li>

            <li class="divider"></li>

            <li><a href="signin.php">SignIn Page</a></li>

            <li><a href="signup.php">SignUp Page</a></li>

            <li class="divider"></li>

            <li><a href="search.php">Search Page</a></li>

          </ul>

        </li>

        

        <li><a href="404.php">404 Page</a></li>

		<li><a href="about.php">About Us</a></li>

        <li><a href="contact.php">Contact</a></li>

      </ul>

    </div>

    <ul class="nav navbar-nav navbar-right menu social-icons">

        <li class="dropdown mega-dropdown search">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-search"></i></a>

          <div class="dropdown-menu">

                    <div class="container">

                        <div class="row">

                        <div class="col-md-6 pull-right">

                    <div class="mega-dropdown-menu">

                        <form class="search-form" action="search.php">

                            <div class="form-group">

                        <div class="col-lg-12">

                            <div class="input-group">

                              <input type="text" class="form-control" placeholder="<?php lang_t("SEARCH_FOR"); ?>...">

                              <span class="input-group-btn">

                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>

                              </span>

                            </div><!-- /input-group -->

                          </div>

                          </div>

                      </form>

                    </div>

                    </div>

                    </div>





                    </div>   

                </div>

        </li>

        <li><a href="#"><i class="fa fa-facebook"></i></a></li>

        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

        <li><a href="#"><i class="fa fa-twitter"></i></a></li>

        <li><a href="signin.php"><i class="fa fa-user"></i></a></li>

      </ul>

    <!--/.nav-collapse --> 

  </div>

</nav>

</header>		
