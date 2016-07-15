
    		</td>
	</tr>
</table><!-- ./wrapper -->
	
    <!-- jQuery 2.1.4 -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/jQuery-2.1.4.min.js"></script>

	<!-- El Framework js de scorpion cms -->
	
	<script type="text/javascript">
		
		var urlbase = "<?=get_config("siteurl")?>";
	
	</script>
	
	
	<script src="<?php get_template_directory_uri_admin(); ?>/js/scorpion.framework.min.js"></script>
	
	
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/bootstrap.min.js"></script>
	
	<?php if(isset($script_footer)) echo $script_footer; ?>
	
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/bootstrap3-wysihtml5.all.min.js"></script>
	
    <!-- Slimscroll -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <!-- FastClick -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php get_template_directory_uri_admin(); ?>/js/app.js"></script>

		
		<?php if(isset($msg)) echo msg($msg); ?>	
	
  </body>
</html>