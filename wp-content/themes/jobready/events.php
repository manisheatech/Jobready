<?php
/**
 * Template Name: Events
 */

get_header(); 
$pfeat_image = wp_get_attachment_url( get_post_thumbnail_id() );

$args = array(
	'post_type'			=> 'event',
	'posts_per_page'	=> 6,
	'meta_key'			=> 'date',
	'orderby'			=> 'meta_value',
	'order'				=> 'DESC'
);
$mloop = new WP_Query( $args );
?>
<style type="text/css">
body{
    background-color: #eeeeee;
    background-image: url("<?php echo $pfeat_image; ?>");
    background-position: center top -85px;
    background-repeat: no-repeat;
    height: 1000px;	
}
</style>
<div class="wrap">
	<div id="primary" class="content-area">
		<?php if ( $mloop->have_posts() ) :?>
        <section>
          <div class="container">
            <div class=" mgt-events">
              <ul class="events_card">
                <?php
                $popups = '';
                while ( $mloop->have_posts() ) : $mloop->the_post();
                    $feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
                    $location = get_field('location');
					$date = get_field('date', false, false);
					$date = new DateTime($date);
                ?>
                <li>
                    <div class="events_image"><img alt="" src="<?php echo $feat_image; ?>" /></div>
                    <div class="events_details">
                        <div class="event_name"><?php the_title('<p>', '</p>'); ?></div>
                        <?php if(!empty($location)){ ?><div class="event_location"><p>Event Location. <?php echo $location; ?></p></div><?php } ?>
                        <div class="event_date"><p><?php echo $date->format('l F jS'); ?></p></div>
                        <div class="event_brifs"><?php the_content(); ?></div>
                        <div class="bor-short"></div>
                    </div>
                </li>
                <?php 
                endwhile;
                ?>
              </ul>
            </div>
          </div>
        </section>
        <?php endif; wp_reset_postdata(); ?>
	</div><!-- #primary -->
</div><!-- .wrap -->
<?php get_footer();