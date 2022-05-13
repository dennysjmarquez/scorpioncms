<!DOCTYPE html>
<html lang="en">
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

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="<?php get_template_directory_uri_admin(); ?>/images/favicon.ico">

    <title><?=lang_s("AUTH_TITLE")?></title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="<?php get_template_directory_uri_admin(); ?>/css/bootstrap.min.css" type="text/css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php get_template_directory_uri_admin(); ?>/css/font-awesome.min.css">
	
    <link rel="stylesheet" href="<?php get_template_directory_uri_admin(); ?>/css/style.css" type="text/css">
    
	<link rel="stylesheet" href="<?php get_template_directory_uri_admin(); ?>/css/AdminLTE.min.css" type="text/css">
	

	

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->
    </head>

	<body class="bglogin">

		<table border="0" width="100%" height="80%">
		<tr>
			<td align="center" class="aniscale">
			
			<img style="height: auto; width: 210px;" src="<?php get_template_directory_uri_admin(); ?>/images/logo.png" class="img-responsive" alt="image post">

			<div style="font-size: 25px;margin: 20px 0px;font-weight: 700;color: #fff;"><?php echo get_config("site_description"); ?></div>

				<form class="entry-form" action="<?=get_uri()?>/auth/signin/" method="post" role="form" autocomplete="off">

					<input autocomplete="off" name="login" id="login" tabindex="1" class="form-control width-1" placeholder="<?=lang_s("LOGIN_PLACEHOLDER")?>" value="<?= $getv['values']['login'] ?>" type="text">

					<input name="password" id="password" tabindex="2" class="form-control width-1" placeholder="<?=lang_s("PASSWORD_PLACEHOLDER")?>" type="password">
						
					<input name="submit" tabindex="4" class="btn btn-default btn-lg" value="<?=lang_s("SIGNIN_SUBMIT_INPUT")?>" type="submit" style="height: 40px; width: 98px; font-size: 13px; font-weight: 600;">

					<input name="session_key" value="<?php echo $session_key; ?>" type="hidden">
					<input name="token" value="<?php echo $token; ?>" type="hidden">

				</form>				
			
			</td>
		</tr>
		</table>
		
		<?php if(isset($msg)) echo msg($msg); ?>
		
	<!-- jQuery 2.1.4 -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/bootstrap.min.js"></script>		
		
	</body>
</html>