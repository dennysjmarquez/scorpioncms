<form name="post" action="<?=get_config("siteurl").'/admin/options/'.$modulo.'/'?>" accept-charset="UTF-8" method="post" id="post" style="height:100%">

<table width="100%" height="100%">
	<tr>
		<td height="100%">
			
			<!-- Content Header (Page header) -->
			<div id="content_header">
				<div class="arrow box6 box-header section" style="">
					<h3 class="box-title">
					<?php if(isset($controller_title)) echo $controller_title; ?>
					<small><?GetTitle_Admin()?></small>			
					</h3>
				</div>
			</div>		
		<div style="padding: 15px;"></div>
		<div class="nav-tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a aria-expanded="false" href="#tab_1" data-toggle="tab"><?=lang_s('_SITE')?></a></li>
			</ul>

			<div class="tab-content">
				
				<div class="tab-pane active" id="tab_1">
				
					<table width="100%" class="nopadding options">
						<tr>
							<td width="200" style="vertical-align: middle;"><label><?=lang_s('SITE_TITLE')?></label></td>
							<td><div style="width: 25em;"><input name="site-name" id="site-name" value="<?=$optios_input['site']['site_name']?>" placeholder="" class="form-control" autocomplete="off" maxlength="255" type="text"></div></td>
						</tr>
						
						<tr>
							<td width="200" style="vertical-align: middle;"><label><?=lang_s('_DESCRIPTION')?></label></td>
							<td><div style="width: 25em;"><input name="site-description" id="site-description" value="<?=$optios_input['site']['site_description']?>" placeholder="" class="form-control" autocomplete="off" maxlength="255" type="text"></div></td>
						</tr>

						<tr>
							<td width="200" style="vertical-align: middle;"><label><?=lang_s('SITE_LANGUAGE')?></label></td>
							<td>
							
								<div style="width: 25em;">
									<select name="site-lang" id="site-lang">
										<?=$optios_input['site']['site_lang']?>
									</select>
								</div>
								
							</td>
						</tr>
						
						
					</table>
					
					
                  
			</div>
		</div>				
		
		</td>
	</tr>
	<tr>
		<td>
		
			<div class="toolbar">
				<div class="">
					<input name="publish" id="publish" class="btn btn-primary" value="<?=lang_s("_save")?>" type="submit">
				</div>
			</div>				
		
		</td>
	</tr>
</table>
	
	


</form>