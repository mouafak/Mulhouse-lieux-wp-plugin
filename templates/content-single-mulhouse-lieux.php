<div class="top_heading_out">
    <div class="top_site_main" style="color: #ffffff;background-image:url(<?php echo get_the_post_thumbnail_url($post->ID); ?>);"><span class="overlay-top-header" style="background-color:rgba(0,0,0,0.5);"></span>
        <div class="page-title-wrapper">
            <div class="banner-wrapper container">
                <h2><?php the_title(); ?></h2>
            </div>
        </div>
    </div>
</div>


<div class="container site-content">
    <div class="row">
        <main id="main" class="site-main col-sm-12 full-width">

            <div class="page-content">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                    <div class="page-content-inner">

                        <header class="entry-header">
                            <div class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </div>
                        </header>

                        <div class="post-formats-wrapper">
                            <a class="post-image" href="<?php the_permalink(); ?>">
                                <img class="attachment-full size-full wp-post-image" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="<?php the_title(); ?>" width="1920" height="1080" >
                            </a>
                        </div>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <div class="entry-tag-share">
                        <div id="map"></div>
                        </div>

                        <div class="entry-tag-share">
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <?php
                                    if ( get_the_tag_list() ) {
                                        echo get_the_tag_list( '<p class="post-tag"><span>' . esc_html__( "Tag:", 'eduma' ) . '</span>', ', ', '</p>' );
                                    }
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php do_action( 'thim_social_share' ); ?>
                                </div>
                            </div>
		                </div>

		                <?php //do_action( 'thim_about_author' ); ?>

                        <?php
		                    $prev_post = get_previous_post();
		                    $next_post = get_next_post();
		                ?>

                        <?php 
                        if ( !empty( $prev_post ) || !empty( $next_post ) ): 
                        ?>
                        <div class="entry-navigation-post">
                            <?php
                                if ( !empty( $prev_post ) ):
                            ?>
                                <div class="prev-post">
                                    <p class="heading"><?php echo esc_html__( 'Lieu précédent', 'eduma' ); ?></p>
                                    <h5 class="title">
                                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo esc_html( $prev_post->post_title ); ?></a>
                                    </h5>

                                    <div class="date">
                                        <?php echo get_the_date( get_option( 'date_format' ) ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                                if ( !empty( $next_post ) ):
                            ?>
                                <div class="next-post">
                                    <p class="heading"><?php echo esc_html__( 'Lieu suivant', 'eduma' ); ?></p>
                                    <h5 class="title">
                                        <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo esc_html( $next_post->post_title ); ?></a>
                                    </h5>

                                    <div class="date">
                                        <?php echo get_the_date( get_option( 'date_format' ), $next_post->ID ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

		            <?php endif; ?>


                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if (comments_open() || '0' != get_comments_number()) :
                            comments_template();
                        endif;
                    ?>

                    </div>
                </article>
            </div>

        </main>
    </div>
</div>