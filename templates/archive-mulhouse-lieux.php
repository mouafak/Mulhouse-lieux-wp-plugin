<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Eduma
 * @since Eduma
 */

get_header();

?>

<div class="lieu-archive-container">

	<?php if(have_posts()) : 
		while (have_posts()) : the_post(  ); ?>
	
				
				<div class="lieu-container" >

					<div class="lieu-image" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID); ?>);" >
					</div>
					<div class="lieu-info">
	    				<div class="group-titre-adresse">
						<h2><?php the_title(); ?></h2>
							<small class="small"><i>
								<svg xmlns="http://www.w3.org/2000/svg" width="12.263" height="16.351" viewBox="0 0 12.263 16.351">
									<path id="Icon_awesome-map-marker-alt" data-name="Icon awesome-map-marker-alt" 				d="M5.5,16.021C.861,9.294,0,8.6,0,6.132a6.132,6.132,0,1,1,12.263,0c0,2.472-.861,3.163-5.5,9.89a.767.767,0,0,1-1.26,0Zm.63-7.335A2.555,2.555,0,1,0,3.577,6.132,2.555,2.555,0,0,0,6.132,8.687Z" fill="#0270b5"/>
								</svg>

								</i> <?php get_post_meta( $post->ID, "_address_meta_box_value_key", true ); ?>
							</small>
						</div>
						<a class="lieu-info-button" href="<?php the_permalink(); ?>">
							Plus d'info 
							<svg xmlns="http://www.w3.org/2000/svg" width="15.504" height="10.705" viewBox="0 0 31.504 30.705">
                    <path id="Icon_awesome-arrow-right" data-name="Icon awesome-arrow-right" d="M13.395,4.7l1.561-1.561a1.681,1.681,0,0,1,2.384,0L31.008,16.8a1.681,1.681,0,0,1,0,2.384L17.339,32.857a1.681,1.681,0,0,1-2.384,0L13.395,31.3a1.689,1.689,0,0,1,.028-2.412L21.9,20.813H1.688A1.683,1.683,0,0,1,0,19.125v-2.25a1.683,1.683,0,0,1,1.688-1.687H21.9L13.423,7.116A1.677,1.677,0,0,1,13.395,4.7Z" transform="translate(0 -2.647)" fill="#fff"/>
                  </svg>
						</a>
					</div>

				</div>

		<?php endwhile; ?>

</div>

		<?php else : ?>
	
			<? _e('nothing to display'); ?>

	<?php endif; ?>



 
<?php get_footer(); ?>