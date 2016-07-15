<div>

<form name="post" action="<?=get_config("siteurl").'/admin/'.get_config('suf_post').'/'.$modulo.'/'?>" accept-charset="UTF-8" method="post" id="post">

<input id="featured_image_new" name="featured_image_new" value="" type="hidden">
	
<table width="100%" height="100%">
	<tr>
		<td valign="top">

		    <!-- Content Header (Page header) -->
			<div id="content_header">
				<div class="arrow box6 box-header section" style="">
					<h3 class="box-title">
					<?php if(isset($controller_title)) echo $controller_title; ?>
					<small><?=GetTitle_Admin()?></small>			
					</h3>
				</div>
			</div>

			<div class="toolbar">
				<div class="">
					<input name="publish" id="publish" class="btn btn-primary" value="<?=lang_s("_save")?>" type="submit">
				</div>
			</div>

		
		
		
		<div class="nav-tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a aria-expanded="false" href="#tab_1" data-toggle="tab"><?=lang_s('_CONTENT')?></a></li>
				<li class=""><a aria-expanded="true" href="#tab_2" data-toggle="tab"><?=lang_s('POST_TYPE_OPTIONS')?></a></li>
			</ul>

			<div class="tab-content">
				
				<div class="tab-pane active" id="tab_1">
				
				
						<div class="panel panel-default panel-margin-bottom theme-panel">
		
		<div class="panel-body" style="padding: 0px;">
		
		<label for="post_title">
		<?=lang_s("_title")?> *
		</label>
		<input style="margin: 0px; height: 50px; font-size: 1.7em; color: rgb(50, 55, 60);" class="form-control" name="post_title"  size="30" value="<?=$QueryAdmin->post("title")?>" id="post_title" spellcheck="true" autocomplete="off" type="text">
			
			<span style="display: block; margin: 20px 0px 0px;">
				<label><?=lang_s("URL_SLUGS")?>:</label>	
				<input id="post-slug" name="post-slug" class="form-control" style="padding:0px; display: inline-block; font-size: 13px;height: 24px;margin: 0px;width: 16em;" value="<?=$QueryAdmin->post("name")?>" type="text">
			</span>
		
		</div>
		</div>
		
		<div class="panel panel-default theme-panel">
			<div class="panel-body" style="padding: 0px;">
			
			<textarea style="resize: none;" cols="80" id="post-content" name="post-content" rows="10">
			<?=$QueryAdmin->post("content")?>
			</textarea>
		
			</div>
			</div>	

				
				
				</div>
				
				<div class="tab-pane" id="tab_2">
				
				<div class="col-md">
				
				
                  <label><?=lang_s("featured_image")?></label>
				  
                    <div id="featured-image" class="box-body"  style="display:none">

						<div class="media-featured-image-container">
							<div class="sidebar-image-placeholder-container">
							<div class="sidebar-image-placeholder featured-image">
							</div>
							</div>
							<div class="info">
								<h4 class="filename">
								<span id="filename"></span>
									<a href="javascript:;" class="upload-remove-button"><i class="icon-times"></i></a>
								</h4>
								<p id="size" class="size"></p>
							</div>							
						</div>
					
                    </div>				  
				  
				  
                    <div id="add-image" class="box-body">

						<div class="media-featured-image-container">
							<div class="sidebar-image-placeholder-container">
							<div class="sidebar-image-placeholder featured-image">

							<a href="javascript:;" style="width: 260px;height: 260px;" class="upload-button">
								<span class="upload-button-icon oc-icon-plus"></span>
							</a>
							
							</div>
							</div>	 
						</div>					
					
                    </div>				
                		
				</div>
				
				</div>
                  
			</div>
		</div>	

		
		
		</td>
		<td width="300" style="vertical-align: top;background-color: #ECF0F1; max-width: 300px !important;padding-bottom: 20px !important;">
				
                <div class="box">

                  <div class="box5 box-header"><h3 class="box-title"><?=lang_s("_publishing")?></h3></div>

                    <div class="box-body">

						<div><label for="post_status"><?=lang_s("_Status")?>:</label>

							<div style="display: block;" id="post-status-select" >
								<input name="post_status" id="post_status" value="publish" type="hidden">
								<select name="post_status" id="post_status" class="form-control post_status" style="width: 100%;">
								<?php 
								
								$option[0] = "publish";
								$option[1] = "pending";
								$optionr = array();

								for($a = 0; $a < count($option); $a++){
									
									$optionr[count($optionr)] = $option[$a];
								
								}
								
								for($a = 0; $a < count($optionr); $a++){
								
									echo '<option  value="'.$optionr[$a].'">'.lang_s('_'.$optionr[$a],true).'</option>';
								
								}
								
								?>
							</select>
							
							</div>
						</div>					
					</div>
				</div>
				

                <div class="box">

					<div class="box5 box-header"><h3 class="box-title"><?=lang_s("post_type")?></h3></div>
					<div class="box-body">
						
						<select name="post_type" id="post_type" class="post_type">
						<?php 
							
						foreach ($QueryAdmin->get_post_type() as $vars){
							
							if($vars["type"] === 'standard'){

								echo '<option selected="selected" value="'.$vars["type"].'" data-icon="'.$vars["icon"].'">'.$vars["text"].'</option>';
							
							}else{
								
								echo '<option value="'.$vars["type"].'" data-icon="'.$vars["icon"].'">'.$vars["text"].'</option>';
								
							}
							
						}
							
						?>
							
						</select>

						
                    </div>
					
					
					


                    
                </div>
				
				
	
				

                <div class="box">
                  
				  <div class="box5 box-header"><h3 class="box-title"><?=lang_s("_category")?></h3></div>

                    <div class="box-body">
					
						<div style="min-height: 42px; overflow: auto; max-height: 200px; border: 1px solid #D2D6DE; background-color: #fff;">
						<?php foreach($full as $item): ?>
						<?php 
						
							$cate = (($item['level'] - 1 ) > 0) ? str_repeat('|—', ($item['level'] - 1)) . $item['name'] : " | ".$item['name'];
							$checked = ($cate_root_id === $item['id']) ? ' checked' : '';
							$active = ($checked !== '') ? ' active' : '';
							
						?>
						
						

						<div class="radio<?=$active?>">
						<label><input type="radio" value="<?=$item['id']?>" name="post_category"<?=$checked?>><?=$cate?></label>
						</div>
					
						<?php endforeach; ?>
						</div>
					
					</div>
                </div>

                <div class="box">
                  
				  <div class="box5 box-header"><h3 class="box-title"><?=lang_s("_tags")?></h3></div>
				  
                    <div class="box-body">
						<div class="tags">
						<select id="tags" name="tags[]" class="form-control" multiple="multiple">
							
						</select>
						</div>
                    </div>

                </div>


		
		</td>
	</tr>
</table>

</form>
           
   </div>