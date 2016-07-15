<?php 
					
	$user =  $QueryAdmin->get_user();
	$date = $user['register_date'];
	$i = strtotime( $date );
	$mes = lang_s(date("F", $i), true);
	$año = date("Y", $i);
	$date = $mes .". " . $año;
						
?>
<!DOCTYPE html>
<html lang="<?=GetCurrLang('SYSLANG')?>">	
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
    <title><?=GetTitle_Admin()?> | <?=get_config("sitename")?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=get_template_directory_uri_admin()?>/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=get_template_directory_uri_admin()?>/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=get_template_directory_uri_admin()?>/css/ionicons.min.css">

    <link rel="stylesheet" href="<?=get_template_directory_uri_admin()?>/css/skins/skin-red-light.min.css">
	
    <link rel="stylesheet" href="<?=get_template_directory_uri_admin()?>/js/bootstrap3-wysihtml5.min.css">
	
	<link rel="stylesheet" href="<?=get_template_directory_uri_admin()?>/css/style.css">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
	<!-- Theme style and Script system add-->
	<?=(isset($script_and_style)) ? $script_and_style : '';?>
	<!-- Theme style -->
    <link rel="stylesheet" href="<?=get_template_directory_uri_admin()?>/css/AdminLTE.min.css">
		 
	
  </head>
  <body class="hold-transition skin-red-light sidebar-mini sidebar-collapse">
  
	<table width="100%" height="100%" class="table-content">
		<tr>
			<td colspan="2" id="content-top">
			
      <header id="main-header" class="main-header">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          
		  <ul class="nav navbar-nav">
			<li><a href="#" class="navicon fa fa-navicon" data-toggle="offcanvas" role="button"></a></li>
			<!-- Sidebar toggle button-->
			<li><a href="<?=get_config('siteurl')?>/" title="<?=get_config("sitename")?>" target="_blank"><?=lang_s("view_site")?></a></li>
		  </ul>
		  
          <div class="navbar-custom-menu">
            <ul class="p nav navbar-nav">
			<?=menu("h")?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">
					<?=lang_s('_howdy').', '.$user["display_name"]?>
					<div class="fa fa-user"> </div>
				  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
					<div class="fa fa-user" style="font-size:90px;color: #f6f6f6;"></div>
                    <p>
					  <?=$user["display_name"]." - ".$user["type"]?>
					  
                      <small><?=lang_s("member_since").' '.$date?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat"><?=lang_s('_profile')?></a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=get_uri()?>/auth/signout/" class="btn btn-default btn-flat"><?=lang_s('sign_out')?></a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>			
			
			</td>
		</tr>
		<tr>
			
			<td id="content-aside-left">
			
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar not-animate">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
			<?php menu("v");?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>			
			
			</td>
		
			<td width="100%" height="100%" id="content-center" > <!--  wrapper  -->
