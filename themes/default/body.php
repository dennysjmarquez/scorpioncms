<section class="content">

    <div class="container">

    <h2 class="heading"><?=get_config("site_description")?></h2>

        <div class="row">

            <div class="col-md-8 col-lg-8">
			
				
				<?php while ( have_posts() ) : the_post(); ?>
  
                   <?php get_template_part( 'types/blog/' . get_post_format() ); ?>
    
                <?php endwhile; ?>				
			
				
                <div class="pagination-wrap">
				
				<?php $Pagination = Pagination(); ?>
				<?php if($Pagination): ?>
				<?php $current = $Pagination["current"]; ?>
				<ul class="pagination">

					<li class="<?php if($Pagination["previous"]["active"] == false ) echo "active"; ?>">

					<?php if($Pagination["previous"]["link"] == null): ?>
					<span aria-hidden="true"><?=lang_s("_previous")?></span>
					<?php else: ?>
					<a href="<?=$Pagination["previous"]["link"]; ?>" aria-label="<?=lang_s("_previous")?>"><?=lang_s("_previous")?></a>
					<?php endif; ?>

					</li>

						
					<?php foreach ($Pagination["pages"] as $key): ?>
					
					<?php if($key["link"] == null): ?>
					
						<li><span><?php echo $key["texto"]; ?></span></li>
					
					<?php else: ?>
						
						<li><a <?php if($key["texto"] == $current) echo 'class="btn-default"'; ?> href="<?php echo $key["link"]; ?>"><?php echo $key["texto"]; ?></a></li>
					
					<?php endif; ?>
					
					
					<?php endforeach; ?>
					
										
					<li class="<?php if($Pagination["next"]["active"] == false ) echo "active"; ?>">

					  <?php if($Pagination["next"]["link"] == null): ?>
					  <span aria-hidden="true"><?=lang_s("_next")?></span>
					  <?php else: ?>
					  <a href="<?php echo $Pagination["next"]["link"]; ?>" aria-label="<?=lang_s("_next")?>"><?=lang_s("_next")?></a>
					  <?php endif; ?>
					  

					</li>

				</ul>
				<?php endif; ?>
			</div>

            <div class="clearfix"></div>

            </div>

            <aside class="col-md-4 col-lg-4">

            	

                <div class="row">

                <div class="col-sm-6 col-md-12 col-lg-12">

                <div class="panel panel-default theme-panel">

                  <div class="panel-heading"><?php lang_s("recent_posts"); ?></div>

                    <div class="panel-body nopadding">

                      <div class="media">

      <div class="media-left">

        <a href="#">

          <img src="<?php get_template_directory_uri(); ?>/images/rp1.jpg" alt="author" />

        </a>

      </div>

      <div class="media-body">

        <h4 class="media-heading"><a href="#">this is long Blog Heading Text Size for recent articles</a></h4>

        <p><a href="#">LifeStyle</a> &bull; 5 hours ago</p>

      </div>

    </div>

    <div class="media">

      <div class="media-left">

        <a href="#">

          <img src="<?php get_template_directory_uri(); ?>/images/rp2.jpg" alt="author" />

        </a>

      </div>

      <div class="media-body">

        <h4 class="media-heading"><a href="#">this is Blog Heading Text Size</a></h4>

        <p><a href="#">Photography</a> &bull; 3 hours ago</p>

      </div>

    </div>

                        <div class="media">

      <div class="media-left">

        <a href="#">

          <img src="<?php get_template_directory_uri(); ?>/images/rp3.jpg" alt="author" />

        </a>

      </div>

      <div class="media-body">

        <h4 class="media-heading"><a href="#">this is Blog Heading Text Size</a></h4>

        <p><a href="#">Products</a> &bull; 2 hours ago</p>

      </div>

    </div>

                    </div>

                </div>

                           </div>

                       <div class="col-sm-6 col-md-12 col-lg-12">

                <div class="panel panel-default theme-panel">

                  <div class="panel-heading"><?php lang_s("_categories"); ?></div>

                    <div class="panel-body nopadding">

                      <div class="list-group">

                      <a href="#" class="list-group-item">LifeStyle</a>

  <a href="#" class="list-group-item">SmartPhones</a>

  <a href="#" class="list-group-item">Business</a>

  <a href="#" class="list-group-item">Graphic Design</a>

  <a href="#" class="list-group-item">Agriculture</a>

                   <a href="#" class="list-group-item">Music</a>

  <a href="#" class="list-group-item">Travel</a>

</div>

                    </div>

                </div>

               </div>

                       

                       <div class="col-sm-6 col-md-12 col-lg-12">

                <div class="panel panel-default theme-panel">

                  <div class="panel-heading"><?php lang_s("_tags"); ?></div>

                    <div class="panel-body">

                      <ul class="list-inline tags">

                        <li><a href="#">LifeStyle</a></li>

                        <li class="big"><a href="#">Music</a></li>

                        <li><a href="#">SmartPhones</a></li>

                        <li><a href="#">Business</a></li>

                        

                        <li><a href="#">Travel</a></li>

                        

                        <li class="big"><a href="#">Business</a></li>

                        <li class="small"><a href="#">LifeStyle</a></li>

                        <li><a href="#">SmartPhones</a></li>

                        

                        <li><a href="#">Fireworks</a></li>

                        <li class="big"><a href="#">Travel</a></li>

                        <li><a href="#">Fireworks</a></li>

                        <li class="small"><a href="#">Music</a></li>

                        </ul>

                    </div>

                </div>

               </div>

                       <div class="col-sm-6 col-md-12 col-lg-12">

                <div class="panel panel-default theme-panel">

                  <div class="panel-heading"><?php lang_s("_archives"); ?></div>

                    <div class="panel-body nopadding">

                      <div class="list-group">

  <a href="#" class="list-group-item">January 2014</a>

  <a href="#" class="list-group-item">February 2014</a>

  <a href="#" class="list-group-item">March 2014</a>

  <a href="#" class="list-group-item">April 2014</a>

                       <a href="#" class="list-group-item">May 2014</a>

</div>

                    </div>

                </div>

               </div>

               </div>

               

            </aside>

           </div>

      </div>

    </section>

<section class="sponsor">

<div class="container">

    	<div class="row">

        	<div class="col-md-12">

            <h2 class="heading">Our Sponsor</h2>

        <div id="sponsor-carousel">

              <div class="item"><a href="#"><img src="<?php get_template_directory_uri(); ?>/images/themeforest.png" alt="themeforest"></a></div>

              <div class="item"><a href="#"><img src="<?php get_template_directory_uri(); ?>/images/themesafari.png" alt="themesafari"></a></div>

              <div class="item"><a href="#"><img src="<?php get_template_directory_uri(); ?>/images/mirchu-net.png" alt="mirchu-net"></a></div>

              <div class="item"><a href="#"><img src="<?php get_template_directory_uri(); ?>/images/smashing-magazine.png" alt="smashing-magazine"></a></div>

              <div class="item"><a href="#"><img src="<?php get_template_directory_uri(); ?>/images/behance.png" alt="behance"></a></div>

            </div>

        </div>

        </div>

</div>        

</section>