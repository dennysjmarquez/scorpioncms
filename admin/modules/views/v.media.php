<?php if(isset($ajax_popup_modal) === true) {echo (isset($script_and_style)) ? $script_and_style : '';} ?>

<div style="height: 100%; display: table; width: 100%; vertical-align: top; overflow: hidden;">


<form style="display:none;" id="form_mediamanager" method="POST" action="<?=get_config("siteurl").'/admin/'.$controller.'/'?>" accept-charset="UTF-8">

	<input id="open_dir" name="open_dir" value="/" type="hidden">
	<input id="current_path" name="current_path" value="<?=$MediaManager->currentpath?>" type="hidden">
	<input id="name_dir" name="name_dir" value="" type="hidden">
	<input id="action_media" name="action" value="" type="hidden">
	<input id="types_files" name="types_files" value="<?=$MediaManager->GetRegex()?>" type="hidden">

</form>

<div style="height: 100%; display: table-row; vertical-align: top;" >

<table width="100%"  height="100%" >
	<tr>
		<td valign="top">

		<?php if(isset($ajax_popup_modal)): ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
		<?php endif;?>
		
		<?php if(!isset($ajax_popup_modal)): ?>
		<div id="media_toolbar" class="toolbar">
		
			<div class="btn-group">
				<button type="button" class="btn btn-primary margin-right fa fa-upload	" id="upload"><?=lang_s("_upload")?></button>
				<button type="button" class="btn btn-primary margin-right fa fa-folder" id="create-folder"><?=lang_s("add_folder")?></button>
			</div>

		</div>
		<?php endif;?>
		
		<div class="arrow box7 box-header">
		<div><?=$MediaManager->get_tree_path()?></div>
		</div>
		
		</td>
		<td rowspan="2"  width="300" width="300" style="vertical-align: top; background-color:#ecf0f1; border-left: 1px solid #e8eaeb; max-width: 300px;">
		
					<div style="position: fixed; padding: 20px 20px 0 20px;width: 300px !important;">
					<div class="media-container-text">
						
						<strong><?=lang_s("media_tips")?></strong>
						<p>
						
						<?=lang_s("details_of_items")?>, <br>
						<strong><?=lang_s("nothing_is_selected")?>.</strong>
						</p>
					</div>
					
					
					<div class="media-preview-container hide"></div>
					
					<div id="media-description" class="panel-media hide" >
					
						<div style="margin-top: 15px;">
					
						<label><?=lang_s('file_name')?>:</label>
						<p id="data-file-name" style="word-wrap: break-word;"></p>
						<table class="name-value-list">
						<tr>
							<th><?=lang_s('_size')?>:</th>
							<td id="data-size"></td>
						</tr>
						<tr>
							<th><?=lang_s('public_url')?>:</th>
							<td><a href="" id="public-url" target="_blank"><?=lang_s('click_here')?></a></td>
						</tr>
						<tr>
							<th><?=lang_s('last_modified')?>:</th>
							<td id="data-modified"></td>
						</tr>

						</table>
						
						</div>
					
					</div>
					</div>
		
		
		</td>
	</tr>
	<tr>
		<td height="100%">
		
					<div id="list_container" style="background-color: #fff;height: 100%; position: relative; overflow: auto;">
						<?=$MediaManager->get_list_items_html()?>
					</div>		
		
		</td>
	</tr>
</table>


		
</div>


<?php if(isset($ajax_popup_modal) === true): ?>
<div class="toolbar-bottom" >
	<div class="pull-right">
		<button type="button" id="popup-insert" class="btn btn-primary"><?=lang_s("_Insert")?></button>
		<button type="button" data-dismiss="popup" class="btn btn-default no-margin-right"><?=lang_s("_Cancel")?></button>
	</div>

</div>
<?php endif; ?>
 
</div>
<?php if(isset($ajax_popup_modal) === true) {echo (isset($script_footer)) ? $script_footer : '';} ?>
<?php if(isset($ajax_popup_modal) === true) {echo (isset($msg)) ? msg($msg) : '';} ?>