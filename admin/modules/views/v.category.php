<div style="padding: 20px">
    <div class="control-toolbar">
        <!-- Control Panel -->
        <div class="toolbar-item toolbar-primary">
            <div>
			<a class="btn btn-primary" title="<?=lang_s('add_category')?>" href="<?=get_config('siteurl').'/admin/'.get_config('suf_category').'/add/'?>"><?=lang_s('add_category')?></a>
			</div>
        </div>
    </div>
</div>
    	<div>

    		<table class="table table-bordered table-hover dataTable" role="grid" id="all_post" >
    		    <thead>
				  <tr>
    		        <th style="width: 0px;">#ID</th>

                    <th class="sorting">
						<?=lang_s('_NAME')?>
    		        </th>

					<th class="sorting">
						<?=lang_s('_TREE')?>
    		        </th>

                    <th class="sorting">
						<?=lang_s('_SLUG')?>
		            </th>
                    <th class="sorting" style="width: 0px;">
						<?=lang_s('_COUNT')?>
		            </th>

				   </tr>
			    </thead>
			    <tbody>

				<?php foreach($full as $item): ?>

				<?php


					$parents = $Tree->Parents('categories', $item['id']);

					$navigator = $name = '';
					$i = 0;

					foreach($parents as $item2) {

						++$i;

						if ($i == count($parents)){

							$name = $item2['slug'];

						}else{

							$navigator .= '/'.$item2['slug'];

						}

					}

					$arbol = get_config("siteurl") . '/' . get_config("suf_category") . $navigator . '/' . $name . '/';

				?>


				   <tr>
					<td style="text-align: center;">
					<?=$item['id']?>
					</td>

                    <td data-title="Status" class="list-cell-index-1 list-cell-name-status_code list-cell-type-text ">

					<?php // if(($item['level'] - 1 ) > 0){ echo str_repeat('|—', ($item['level'] - 1)) . $item['name']; }else{ echo " | ".$item['name'];} ?>
					<?=$item['name']?>

					<div class="row-actions">

					<span class="edit"><a href="<?=get_config("siteurl") . '/admin/'.get_config("suf_category").'/edit/'. $item['id'] .'/'?>" title="<?=lang_s('EDIT_THIS_ELEMENT')?>"><?=lang_s('_EDIT')?></a></span>
					<?php if($item['count'] == 0 && (int)$cate_root_id !== (int)$item['id']): ?>
					<span class="trash"> | <a class="text-red" title="<?=lang_s('DELETE_THIS_ELEMENT')?>" href="<?=get_config("siteurl") . '/admin/'.get_config("suf_category").'/delete/'. $item['id'] .'/'?>"><strong><?=lang_s('_DELETE')?></strong></a></span>
					<?php endif; ?>

					</div>
                    </td>

					<td>


						<span style="display: block;">
							<a class="" title="<?=lang_s('VIEW_CATEGORY')?> “<?=$item['name']?>”" href="<?=$arbol?>" >
							<?=get_config("siteurl") . '/' . get_config("suf_category")?><?=$navigator?>/<span id="editable-post-name"><?=$name?></span>/</a>
						</span>


					</td>

                    <td data-title="URL" class="list-cell-index-2 list-cell-name-url list-cell-type-text column-break-word">
                    <?=$item['slug']?>
                    </td>

                    <td data-title="Counter" class="list-cell-index-3 list-cell-name-count list-cell-type-text" style="text-align: center;">
                    <?=$item['count']?>
                    </td>

				   </tr>
				<?php endforeach; ?>
                </tbody>
			    <tfoot>
				   <tr>
                    <td colspan="4" class="list-pagination nolink">
                    <div class="loading-indicator-container size-small pull-right">
					<div class="control-pagination">
					<span class="page-iteration">

				<div class="col-md-12 text-center">

				<?php $Pagination = $QueryAdmin->Pagination($action, null, get_config('suf_category'), $Tree->TreeTotal); ?>
				<?php if($Pagination): ?>
				<?php $current = $Pagination["current"]; ?>
				<ul class="pagination">

					<li class="<?php if($Pagination["previous"]["active"] == false ) echo "disabled"; ?>">

					<?php if($Pagination["previous"]["link"] == null): ?>
					<span aria-hidden="true"><?=lang_s("_previous")?></span>
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
					  <a href="<?=$Pagination["next"]["link"]?>" aria-label="<?=lang_s("_next")?>"><?=lang_s("_next")?></a>
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
