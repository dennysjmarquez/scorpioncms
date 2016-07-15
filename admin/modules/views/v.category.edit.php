<form name="post" action="<?=get_config("siteurl").'/admin/'.get_config('suf_category').'/'.$modulo.'/'.$action.'/'?>" accept-charset="UTF-8" method="post" id="post" style="height:100%">

<input id="parent_id" name="parent_id" value="<?=$parent_id?>" type="hidden">

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
				<li class="active"><a aria-expanded="false" href="#tab_1" data-toggle="tab"><?=lang_s('_CONTENT')?></a></li>
			</ul>

			<div class="tab-content">
				
				<div class="tab-pane active" id="tab_1">
				
				
					<div class="panel panel-default panel-margin-bottom theme-panel">
						
						<div class="width-48-5 nopadding padding-bottom-20">
						
							<label><?=lang_s('_NAME')?></label>
							<input name="category-name" id="category-name" value="<?=$cate['name']?>" placeholder="" class="form-control" autocomplete="off" maxlength="255" type="text">
						
						</div>
					
						<div class="width-48-5 nopadding padding-bottom-20 pull-right">

							<label><?=lang_s("URL_SLUGS")?></label>
							<input name="category-slug" id="category-slug" value="<?=$cate['slug']?>" placeholder="" class="form-control" autocomplete="off" maxlength="255" type="text">
						
		
						</div>
						
						<div class="nopadding padding-bottom-20">
						
							<label><?=lang_s("PARENT_CATEGORY")?></label>
						
							<select name="category-parent-tree" id="category-parent-tree">
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
					<a class="btn btn-default" title="<?=lang_s('add_category')?>" href="<?=get_config('siteurl').'/admin/'.get_config('suf_category').'/add/'?>"><?=lang_s('add_category')?></a>
					<?php if((int)$cate_root_id !== (int)$category_id): ?>
					<a class="btn btn-danger pull-right" title="<?=lang_s('DELETE_CATEGORY')?>" href="<?=get_config("siteurl") . '/admin/'.get_config('suf_category').'/delete/'. $category_id .'/'?>"><?=lang_s("DELETE_CATEGORY")?></a>
					<?php endif; ?>
				</div>
			</div>				
		
		</td>
	</tr>
</table>
	
	


</form>