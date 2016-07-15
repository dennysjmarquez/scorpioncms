<?php include("header.php"); ?>
<section class="innercontent">

    <div class="container">

    <h2 class="heading"><?=get_config("site_description")?></h2>

        <div class="row">
		

		

            <div class="col-md-8 col-lg-8">

				<?php while ( have_posts() ) : the_post(); ?>
  
                   <?php get_template_part( 'types/post/' . 'post-'.get_post_format() ); ?>
    
                <?php endwhile; ?>					
	
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

          <img src="Single%20Post%20_%20BlogDesk_files/rp1.jpg" alt="author">

        </a>

      </div>

      <div class="media-body">

        <h4 class="media-heading"><a href="#">this is long Blog Heading Text Size for recent articles</a></h4>

        <p><a href="#">LifeStyle</a> • 5 hours ago</p>

      </div>

    </div>

    <div class="media">

      <div class="media-left">

        <a href="#">

          <img src="Single%20Post%20_%20BlogDesk_files/rp2.jpg" alt="author">

        </a>

      </div>

      <div class="media-body">

        <h4 class="media-heading"><a href="#">this is Blog Heading Text Size</a></h4>

        <p><a href="#">Photography</a> • 3 hours ago</p>

      </div>

    </div>

                        <div class="media">

      <div class="media-left">

        <a href="#">

          <img src="Single%20Post%20_%20BlogDesk_files/rp3.jpg" alt="author">

        </a>

      </div>

      <div class="media-body">

        <h4 class="media-heading"><a href="#">this is Blog Heading Text Size</a></h4>

        <p><a href="#">Products</a> • 2 hours ago</p>

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
<?php include("footer.php"); ?>