<div style="padding: 20px">
    <div class="control-toolbar">
        <!-- Control Panel -->
        <div class="toolbar-item toolbar-primary">
            <div>
			<a class="btn btn-primary" title="<?=lang_s('add_post')?>" href="<?=get_config('siteurl').'/admin/'.get_config('suf_post').'/add/'?>"><?=lang_s('add_post')?></a>
			</div>
        </div>
    </div>
</div>	
    	<div>
			
    		<table class="table table-bordered table-hover dataTable" role="grid" id="all_post" >
    		    <thead>
				  <tr>
    		        <th class="sorting_disabled">#ID</th>
	                <th class="sorting">
						<?=lang_s('_STATUS')?>
    		        </th>	
                    <th class="sorting">
						<?=lang_s('_TITLE')?>
    		        </th>
                    <th class="sorting">
						<?=lang_s('_AUTHOR')?>
		            </th>
                    <th class="sorting">
						<?=lang_s('_CATEGORY')?>
		            </th>
                    <th class="sorting">
						<?=lang_s('_TAGS')?>
		            </th>
                    <th class="sorting">
						<?=lang_s('_COMMENTS')?>
		            </th>
                    <th class="sorting">
						<?=lang_s('_DATE')?>
		            </th>
					            
				   </tr>
			    </thead>
			    <tbody>
				<?php while ( $QueryAdmin->have_posts() ) : $QueryAdmin->the_post(); ?>
				   <tr>
					
					<td style="text-align: center;">
					<?=$QueryAdmin->post('id')?>
					</td>    
					
					<td>
					<?=$QueryAdmin->post('status')?>
					</td>    
    
                    <td data-title="Status" class="list-cell-index-1 list-cell-name-status_code list-cell-type-text ">
                    <?php $QueryAdmin->the_title(); ?>
					
					<div class="row-actions">
					<span class="view"><a href="<?=get_config("siteurl") . "/" . get_config("suf_post") ."/". $QueryAdmin->post('name') .'/'?>" title="Ver “<?=$QueryAdmin->post('title')?>”" rel="permalink" target="_blank"><?=lang_s('_VIEW')?></a> | </span>
					<span class="edit"><a href="<?=get_config("siteurl") . '/admin/'.get_config('suf_post').'/edit/'.$QueryAdmin->post('id') .'/'?>" title="<?=lang_s('EDIT_THIS_ELEMENT')?>"><?=lang_s('_EDIT')?></a> | </span>
					<span class="trash"><a class="text-red" title="<?=lang_s('DELETE_THIS_ELEMENT')?>" href="<?=get_config("siteurl") . '/admin/'.get_config('suf_post').'/delete/'.$QueryAdmin->post('id') .'/'?>"><strong><?=lang_s('_DELETE')?></strong></a></span>
					</div>
                    </td>
                    <td data-title="URL" class="list-cell-index-2 list-cell-name-url list-cell-type-text column-break-word">
                    <a href="<?=get_config("siteurl") . '/admin/profile/'. $QueryAdmin->get_author() .'/'?>" title="<?=lang_s('EDIT_THIS')?> “<?=lang_s('_AUTHOR')?>”" rel="permalink"><?php $QueryAdmin->get_author("display_name", true); ?></a>                 
                    </td>
                    <td data-title="Counter" class="list-cell-index-3 list-cell-name-count list-cell-type-text ">
                    <a href="<?=get_config("siteurl") . '/admin/'.get_config('suf_category').'/edit/'.$QueryAdmin->post('category_id') .'/'?>" title="<?=lang_s('EDIT_CATEGORY')?>“<?php $QueryAdmin->get_category_name(null, true) ?>”" rel="permalink"><?php $QueryAdmin->get_category_name(null, true) ?></a>
                    </td>
                    <td data-title="Counter" class="list-cell-index-3 list-cell-name-count list-cell-type-text ">
					<?php $QueryAdmin->get_tag(true); ?>
                    </td>
                    <td data-title="Counter" class="list-cell-index-3 list-cell-name-count list-cell-type-text ">
					<?php $QueryAdmin->get_comments_number(); ?>
                    </td>
                    <td data-title="Counter" class="list-cell-index-3 list-cell-name-count list-cell-type-text ">
					<?php $QueryAdmin->get_date(); ?>
                    </td>
                    
				   </tr>

				<?php endwhile; ?>
                </tbody>
			    <tfoot>
				   <tr>
                    <td colspan="8" class="list-pagination nolink">
                    <div class="loading-indicator-container size-small pull-right">
					<div class="control-pagination">
					<span class="page-iteration">

				<div class="col-md-12 text-center">
				
				<?php $Pagination = $QueryAdmin->Pagination(null, null, get_config('suf_post') ); ?>
				<?php if($Pagination): ?>
				<?php $current = $Pagination["current"]; ?>
				<ul class="pagination">

					<li class="<?php if($Pagination["previous"]["active"] == false ) echo "disabled"; ?>">

					<?php if($Pagination["previous"]["link"] == null): ?>
					<span aria-hidden="true"><?php lang_s("_previous"); ?></span>
					<?php else: ?>
					<a href="<?=$Pagination["previous"]["link"]?>" aria-label="<?=lang_s("_previous")?>"><?=lang_s("_previous")?></a>
					<?php endif; ?>

					</li>

						
					<?php foreach ($Pagination["pages"] as $key): ?>
					
					<?php if($key["link"] == null): ?>
					
						<li><span><?=$key["texto"]?></span></li>
					
					<?php else: ?>
						
						<li <?php if($key["texto"] == $current) echo 'class="active"'; ?> ><a href="<?=$key["link"]?>"><?=$key["texto"]?></a></li>
					
					<?php endif; ?>
					
					
					<?php endforeach; ?>
					
										
					<li class="<?php if($Pagination["next"]["active"] == false ) echo "disabled"; ?>">

					  <?php if($Pagination["next"]["link"] == null): ?>
					  <span aria-hidden="true"><?=lang_s("_next")?></span>
					  <?php else: ?>
					  <a href="<?=$Pagination["next"]["link"]; ?>" aria-label="<?=lang_s("_next")?>"><?=lang_s("_next")?></a>
					  <?php endif; ?>
					  

					</li>

				</ul>
				<?php endif; ?>
			
			
			
				</div>
		            
					
					
		            </span>
                    </div>
                   	</div>              
					</td>
				   </tr>
                </tfoot>
			 </table>
			 
		</div>