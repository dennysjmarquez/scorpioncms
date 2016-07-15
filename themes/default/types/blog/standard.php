
				<article class="post">

                    <div class="author-info">

                       <ul class="list-inline">

                        <li>

                            <div class="icon-box"><img src="<?php get_template_directory_uri(); ?>/images/author.png" class="img-responsive" alt="image post"></div>

                            <div class="info">

                            <p><?=lang_s("posted_by")?>:</p>

                           <a href="author.html">Waqas Hussain</a>

                            </div>    

                        </li>

                        <li>

                            <div class="icon-box"><i class="fa fa-calendar"></i></div>

                            <div class="info">

                            <p><?php lang_s("posted_on"); ?>:</p>

                                <strong><?php get_the_date(); ?></strong></div>

                        </li>

                        

                         <li>

                             <div class="icon-box"><i class="fa fa-comments-o"></i></div>

                             <div class="info">

                             <p><?php lang_s("_comments"); ?>:</p>

                                 <strong><?php get_comments_number(); ?></strong></div>

                         </li>

                         <li>

                            <div class="icon-box"><i class="fa fa-eye"></i></div>

                            <div class="info">

                            <p><?php lang_s("total_view"); ?>:</p>

                                <strong><?php get_views(); ?></strong></div>

                        </li>

                       </ul>

                    </div>

                    <div class="caption">

            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<div>
				<?php the_content("short"); ?>
				</div>
              <div class="post-category">

                <a href="#"><span>&nbsp;</span> Quote Post</a>

              </div>

              <ul class="list-inline tags">

                 

                  <li><a href="#">Products</a></li>

                  <li><a href="#">Business</a></li>

                  <li><a href="#">Photoshop</a></li>

                  <li><a href="#">LifeStyle</a></li>

                  <li><a href="#">Photography</a></li>

              </ul>

              <a class="btn btn-default btn-lg" href="<?php the_permalink(); ?>" role="button"><?=lang_s("read_more")?></a>

          </div>

                </article>