	<div class="home-posts">
			<div class="slick-wrap">

				<div class="top-left-content">
					<h4>2017</h4>
					<p>Our videos will be released once a week’ copy goes here.</p>
				</div><!-- top-left-content -->

				<div class="center-posts">
				<?php $query_args = array(
				  'post_type' => 'post',
				  'posts_per_page' => 4 ,
				  'order' => 'DESC'
				 );
				 
				 $query = new WP_Query( $query_args ); 
					if ( $query->have_posts() ) :  
					    while ( $query->have_posts() ) : $query->the_post(); ?>
							
					    	<div>	
					    		<a href="<?php the_permalink(); ?>">
					    		<div class="slide-content">
					    			<div class="trainer-pic">
					    				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/global/temp-images/trainer-pic.png"/>
					    			</div> <!-- trainer-pic -->
					    			<div class="post-content">
										<time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><span class="day"><?php echo get_the_date('j'); ?></span><span class="month"><?php echo get_the_date('F'); ?></span></time>

										<h5><?php the_title(); ?></h5>
										<?php the_content(); ?>
									</div><!-- post-content -->
								</div> <!-- slide-content -->
								<?php the_post_thumbnail(); ?>
								</a>
							</div>
					      
				<?php 
						endwhile; 
					endif; 
				wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
