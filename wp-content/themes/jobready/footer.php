<?php
/**
 * The template for displaying the footer
 */
$locations = get_nav_menu_locations();
$testimonial = get_field('choose_testimonial');
$page_id = get_the_ID();
global $upage_class;
?>

		</div><!-- #content -->
	</div><!-- .site-content-contain -->
<?php if($page_id != 16 && $page_id != 340){
	if(!empty($testimonial)){
		$tloop = $testimonial;
	?>
	<section class="testimonials <?php if(is_front_page()){ ?>testimonialsHome<?php } ?> <?php if(!empty($upage_class)){ echo 'testimonials'.$upage_class; } ?>">
		<div class="container">
			<div class="col-md-offset-1 col-md-10">
				
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  			<div class="carousel-inner" role="listbox">
						<?php  
							$testi_image = wp_get_attachment_url( get_post_thumbnail_id($tloop->ID) );
						?>
		    			<div class="item active">
		    				<div class="testiBlock">
								<?php if(!empty($testi_image)){ ?>
		    					<img src="<?php echo $testi_image; ?>" alt="" />
								<?php } ?>
		    					<?php echo $tloop->post_content; ?>
								<h5><?php echo $tloop->post_title; ?></h5>
		    				</div>
		    			</div>
		  			</div>
				</div>
				
			</div>
		</div>
	</section>
	<?php
	}else{
		$args = array( 'post_type' => 'testimonial', 'posts_per_page' => -1, 'order' => 'ASC' );
		$tloop = new WP_Query( $args );
		
		if ( $tloop->have_posts() ) :
	?>
	<section class="testimonials <?php if(is_front_page()){ ?>testimonialsHome<?php } ?>">
		<div class="container">
			<div class="col-md-offset-1 col-md-10">
				
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  			<div class="carousel-inner" role="listbox">
						<?php $t = 0; 
						while ( $tloop->have_posts() ) : $tloop->the_post();
							$testi_image = wp_get_attachment_url( get_post_thumbnail_id() );
						?>
		    			<div class="item<?php if($t < 1){ ?> active<?php } ?>">
		    				<div class="testiBlock">
								<?php if(!empty($testi_image)){ ?>
		    					<img src="<?php echo $testi_image; ?>" alt="" />
								<?php } ?>
		    					<?php the_content(); ?>
								<h5><?php the_title(); ?></h5>
		    				</div>
		    			</div>
						<?php $t++;
						endwhile;
						?>
		  			</div>
				</div>
				
			</div>
		</div>
	</section>
	<?php 
		endif; 
	}
	wp_reset_postdata();
	?>
	
	<?php
		$args = array( 'post_type' => 'client_logo', 'posts_per_page' => -1, 'order' => 'ASC' );
		$cloop = new WP_Query( $args );
		if ( $cloop->have_posts() ) :
	?>
	<section id="brandCarousel">
		<div class="container">
			<div class="col-md-12">
				<h2>Just some of our happy customers</h2>
			</div>
			<div class="col-md-12">
				<div class="jcarousel-wrapper">
	                <div class="jcarousel">
	                    <ul>
							<?php $c = 0; 
							while ( $cloop->have_posts() ) : $cloop->the_post();
								$logo_image = wp_get_attachment_url( get_post_thumbnail_id() );
								if(!empty($logo_image)){
							?>
	                        <li><img src="<?php echo $logo_image; ?>" alt=""></li>
							<?php 
									$c++;
								}
							endwhile;
							?>
	                    </ul>
	                </div>
	
	                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
	                <a href="#" class="jcarousel-control-next">&rsaquo;</a>
	
	            </div>
			</div>
		</div>
	</section>
	
	<?php 
		endif; 
}
wp_reset_postdata();
?>
	
	<footer>
				
		<div class="footerNav">
			<div class="col-md-12">
				<?php 
				if ( has_nav_menu( 'footer' ) ) : 
					$menu_items = (array)wp_get_nav_menu_items($locations[ 'footer' ]);
					$menu_list = '';
					if(!empty($menu_items)){
						$menu_list .= '<ul>';
						foreach ( $menu_items as $key => $menu_item ) {
							$title = $menu_item->title;
							$url = $menu_item->url;
							$target = ($menu_item->target) ? 'target="_blank"' : '';
							$classes = implode(' ', $menu_item->classes);
							$menu_list .= '<li class="'.$classes.'"><h3><a href="' . $url . '" '.$target.'>'.$title.'</a></h3></li>';
						}
						$menu_list .= '</ul>';
					}
					echo $menu_list;
				endif; 
				?>
			</div>
		</div>
			
		<div class="container">
			
			<div class="row">
				<div class="col-sm-3">
					<div class="leftBlock">
					<?php
					// Footer links navigation menu.
					$menu_items = (array)wp_get_nav_menu_items('Footer Left Menu');
					$menu_list = '';
					if(!empty($menu_items)){
						foreach ( $menu_items as $key => $menu_item ) {
							$title = $menu_item->title;
							$url = $menu_item->url;
							$target = ($menu_item->target) ? 'target="_blank"' : '';
							$classes = implode(' ', $menu_item->classes);
							$menu_list .= '<p class="'.$classes.'"><a href="' . $url . '" '.$target.'>'.$title.'</a></p>';
						}
					}
					echo $menu_list;
					?>
					</div>
				</div>
				<div class="col-sm-6">
					<?php echo do_shortcode( '[contact-form-7 id="39" title="Contact us now"]' ); ?>
				</div>
				<div class="col-sm-3">
					<div class="rightBlock">
						<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
						<?php
						if ( has_nav_menu( 'social' ) ) : 
							// Social links navigation menu.
							$menu_items = (array)wp_get_nav_menu_items($locations[ 'social' ]);
							$menu_list = '<h5>FOLLOW US</h5>';
							if(!empty($menu_items)){
								$menu_list .= '<ul class="socialIcon">';
								foreach ( $menu_items as $key => $menu_item ) {
									$title = $menu_item->title;
									$url = $menu_item->url;
									$target = ($menu_item->target) ? 'target="_blank"' : '';
									$classes = implode(' ', $menu_item->classes);
									$menu_list .= '<li class="'.$classes.'"><a href="' . $url . '" '.$target.'><img src="'.get_stylesheet_directory_uri().'/images/'.$menu_item->classes[0].'.png" alt="'.$title.'" /></a></li>';
								}
								$menu_list .= '</ul>';
							}
							echo $menu_list;
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footerBottom">
			<div class="container">
				<?php get_template_part( 'template-parts/footer/site', 'info' ); ?>
			</div>
		</div>
	</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jcarousel.responsive.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.js"></script> <!-- Bootstrap jQuery -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap-portfilter.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/main.js"></script> <!-- Resource jQuery -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.sticky.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/js.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.stellar.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/owl.carousel.js"></script> <!-- Owl Carousel -->
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#input_3_14").unwrap();
	jQuery("#input_3_15").unwrap();
	jQuery('#comments_contact').attr('rows', '3');
	jQuery('#apply_message').attr('rows', '3');
	jQuery('#message_contact').attr('rows', '4');
	jQuery('.enqtran-send-mail').addClass('form-inline');
	jQuery('.enqtran-send-mail').removeClass('form-horizontal');
	jQuery('.enqtran_sub_emails').addClass('form-control');
	jQuery('.enqtran_sub_emails').attr('placeholder', 'Your email');
	jQuery('.enqtran_sub_emails').wrap( "<div class='form-group'></div>" )
	jQuery('.submit_email_enqtran').val('Submit');
	jQuery('.jcarousel').jcarousel({
        wrap: 'circular'
    })
    .jcarouselAutoscroll({
        target: '+=1',
        interval: 10000
    });
	jQuery('.carousel').carousel({
		interval: 3000
	});

  var owl = jQuery('#owl-demo');
  owl.on('initialize.owl.carousel initialized.owl.carousel ' +
	'initialize.owl.carousel initialize.owl.carousel ' +
	'resize.owl.carousel resized.owl.carousel ' +
	'refresh.owl.carousel refreshed.owl.carousel ' +
	'update.owl.carousel updated.owl.carousel ' +
	'drag.owl.carousel dragged.owl.carousel ' +
	'translate.owl.carousel translated.owl.carousel ' +
	'to.owl.carousel changed.owl.carousel', function(e) {
	  jQuery('.' + e.type)
		.removeClass('secondary')
		.addClass('success');
	  window.setTimeout(function() {
		jQuery('.' + e.type)
		  .removeClass('success')
		  .addClass('secondary');
	  }, 500);
	});
  owl.owlCarousel({
	loop: true,
	nav: true,
	lazyLoad: true,
	margin: 10,
	video: true,
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 2
	  },
	  1200: {
		items: 4
	  }
	}
  });

  var owl = jQuery('#owl-demo1');
  owl.on('initialize.owl.carousel initialized.owl.carousel ' +
	'initialize.owl.carousel initialize.owl.carousel ' +
	'resize.owl.carousel resized.owl.carousel ' +
	'refresh.owl.carousel refreshed.owl.carousel ' +
	'update.owl.carousel updated.owl.carousel ' +
	'drag.owl.carousel dragged.owl.carousel ' +
	'translate.owl.carousel translated.owl.carousel ' +
	'to.owl.carousel changed.owl.carousel', function(e) {
	  jQuery('.' + e.type)
		.removeClass('secondary')
		.addClass('success');
	  window.setTimeout(function() {
		jQuery('.' + e.type)
		  .removeClass('success')
		  .addClass('secondary');
	  }, 500);
	});
  owl.owlCarousel({
	loop: true,
	nav: true,
	navigation : true,
	autoWidth:true,
	margin: 10,
	autoplay:true,
	autoplayTimeout: 2000,
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 1
	  },
	  1200: {
		items: 2
	  }
	}
  });
});
</script>
</body>
</html>