
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

                            <p><?=lang_s("posted_on")?>:</p>

                                <strong><?php get_the_date(); ?></strong></div>

                        </li>

                        

                         <li>

                             <div class="icon-box"><i class="fa fa-comments-o"></i></div>

                             <div class="info">

                             <p><?=lang_s("_comments")?>:</p>

                                 <strong><?php get_comments_number(); ?></strong></div>

                         </li>

                         <li>

                            <div class="icon-box"><i class="fa fa-eye"></i></div>

                            <div class="info">

                            <p><?=lang_s("total_view")?>:</p>

                                <strong><?php get_views(); ?></strong></div>

                        </li>

                       </ul>

                    </div>

                    <div class="caption">

            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<?php the_content(); ?>

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

          </div>
		  
                    <div class="share-this">

                        <div class="row">

                            <div class="col-xs-5 col-sm-4 col-md-5 col-lg-4"><p>Share this post with:</p></div>

                                <div class="col-xs-7 col-sm-8 col-md-7 col-lg-8 nopadding">

                                    <ul class="list-inline">

                                         

                                          <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>

                                          <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>

                                          <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>

                                    </ul>

                                </div>

                            </div>

                    </div>

                    <div class="related-post">

                        <div class="row">

                            <div class="col-md-12"><h4><?=lang_s("related_topics")?></h4></div>

                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                                <div class="thumbnail">

                                  <a href="#"><img src="Single%20Post%20_%20BlogDesk_files/related-post1.png" alt="related post"></a>

                                  <div class="caption">

                                    <a href="#">Cras sit amet nibh libero, in gravida nulla</a>

                                  </div>

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                                <div class="thumbnail">

                                    <a href="#"><img src="Single%20Post%20_%20BlogDesk_files/related-post2.png" alt="related post"></a>

                                  <div class="caption">

                                    <a href="#">Cras sit amet nibh libero, in gravida nulla</a>

                                  </div>

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                                <div class="thumbnail">

                                    <a href="#"><img src="Single%20Post%20_%20BlogDesk_files/related-post3.png" alt="related post"></a>

                                  <div class="caption">

                                    <a href="#">Cras sit amet nibh libero, in gravida nulla</a>

                                  </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="comment-count">

                        <h4>32 Comments</h4>

                        <p><a href="#">Sign in</a> to comment or comment as a guest.</p>

                    </div>

                    <div class="comment-list">

                        <div class="media">

                          <div class="media-left">

                            <a href="#">

                              <img class="media-object" src="Single%20Post%20_%20BlogDesk_files/comment-thumbnail.png" alt="placeholder image">

                            </a>

                          </div>

                          <div class="media-body">

                            <p>Cras sit amet nibh libero, in gravida 
nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
 odio, vestibulum in vulputate at, tempus viverra turpis. </p>

                              <ul class="list-inline">

                                  <li><a class="media-heading" href="#">Anonymous</a></li>

                                  <li>3 hours ago</li>

                                  <li><a class="reply-btn" href="#"><?=lang_s("post_reply")?></a></li>

                                </ul>

                              

                          </div>

                        </div>

                        <div class="media">

                          <div class="media-left">

                            <a href="#">

                              <img class="media-object" src="Single%20Post%20_%20BlogDesk_files/comment-thumbnail.png" alt="placeholder image">

                            </a>

</div>

                          <div class="media-body">

                            

                            <p>Cras sit amet nibh libero, in gravida 
nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
 odio, vestibulum in vulputate at, tempus viverra turpis. </p>

                              <ul class="list-inline">

                                  <li><a class="media-heading" href="#">Anonymous</a></li>

                                  <li>3 hours ago</li>

                                  <li><a class="reply-btn" href="#"><?=lang_s("post_reply")?></a></li>

                                </ul>

                            <div class="media nested-first">

                              <div class="media-left">

                                <a href="#">

                                  <img class="media-object" src="Single%20Post%20_%20BlogDesk_files/comment-thumbnail.png" alt="placeholder image">

                                </a>

                              </div>

                              <div class="media-body">

                                

                               <p> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p>

                                  <ul class="list-inline">

                                  <li><a class="media-heading" href="#">Anonymous</a></li>

                                  <li>3 hours ago</li>

                                </ul>

                              </div>

</div>

                            <div class="media">

                              <div class="media-left">

                                <a href="#">

                                  <img class="media-object" src="Single%20Post%20_%20BlogDesk_files/comment-thumbnail.png" alt="placeholder image">

                                </a>

                              </div>

                              <div class="media-body">

                               <p> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p>

                                  <ul class="list-inline">

                                  <li><a class="media-heading" href="#">Anonymous</a></li>

                                  <li>3 hours ago</li>

                                </ul>

                              </div>

</div>

</div>

                        </div>

                    </div>

                    <div class="comment-form">

                        <h4><?=lang_s("post_a_reply")?></h4>

                        <form role="form" action="#" method="post" novalidate="" id="comment-form">

                            <div class="row">

                                <div class="col-md-6 col-lg-5">

                           <div class="form-group">

                             <input class="form-control" name="name" autocomplete="off" placeholder="<?php lang_t("FULL_NAME"); ?>:" type="text">

                           </div>

                                    </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 col-lg-5">

                          <div class="form-group">

                            <input class="form-control" name="email" autocomplete="off" placeholder="<?php lang_t("ENTER_ADDRESS"); ?>:" type="email">

                          </div>

                                    </div>

                                    </div>

                            <div class="row">

                                <div class="col-md-6 col-lg-5">

                            <div class="form-group">

                            <input class="form-control" placeholder="<?php lang_t("PHONE_NUMBER"); ?>:" type="text">

                          </div>

                            </div>

                                    </div>

                            <div class="form-group">

                                <textarea class="form-control" name="message" placeholder="<?php lang_t("_MESSAGE"); ?>:" rows="3"></textarea>

                          </div>

                          <button type="submit" class="btn btn-default"><?=lang_s("post_reply")?></button>

                        </form>

                    </div>
					

                </article>