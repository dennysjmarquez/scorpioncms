<form name="post" action="<?=get_config("siteurl").'/admin/'.get_config('suf_category').'/'.$modulo.'/'?>" accept-charset="UTF-8" method="post" id="post" style="height:100%">

<table width="100%" height="100%">
	<tr>
		<td height="100%">
			
			<!-- Content Header (Page header) -->
			<div id="content_header">
				<div class="arrow box6 box-header section" style="">
					<h3 class="box-title">
					<?php if(isset($controller_title)) echo $controller_title; ?>
					<small><?=GetTitle_Admin()?></small>
					</h3>
				</div>
			</div>		
		<div style="padding: 15px;"></div>
		<div class="nav-tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a aria-expanded="false" href="#tab_1" data-toggle="tab"><?=lang_s('_GENERAL')?></a></li>
			</ul>

			<div class="tab-content">
				
				<div class="tab-pane active" id="tab_1">
				
				
					<div class="panel panel-default panel-margin-bottom theme-panel">
						
						<div class="width-48-5 nopadding padding-bottom-20">
						
							<label><?=lang_s('_NAME')?></label>
							<input name="category-name" id="category-name" value="<?=$cate['category_name']?>" placeholder="" class="form-control" autocomplete="off" maxlength="255" type="text">
						
						</div>
					
						<div class="width-48-5 nopadding padding-bottom-20 pull-right">

							<label><?=lang_s("URL_SLUGS")?></label>
							<input name="category-slug" id="category-slug" value="<?=$cate['category_slug']?>" placeholder="" class="form-control" autocomplete="off" maxlength="255" type="text">
						
		
						</div>
						
						<div class="nopadding padding-bottom-20">
						
							<label><?=lang_s("PARENT_CATEGORY")?></label>
						
							<select name="category-parent" id="category-parent">
								<?=$catsehtml?>
							</select>
						
						</div>
						
				
				
				</div>
				
                  
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