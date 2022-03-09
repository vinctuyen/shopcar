<?php
/**
 * Template Name: Home Custom Page
 */
?>

<?php get_header(); ?>

<main id="main" role="main">
  <?php do_action( 'watch_store_above_slider' ); ?>
    <?php if( get_theme_mod('watch_store_slider_hide_show', false) != ''){ ?> 
      <section id="slider" class="m-0 p-0 mw-100">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"> 
          <?php $watch_store_content_pages = array();
            for ( $count = 1; $count <= 4; $count++ ) {
              $mod = intval( get_theme_mod( 'watch_store_slider_page' . $count ));
              if ( 'page-none-selected' != $mod ) {
                $watch_store_content_pages[] = $mod;
              }
            }
            if( !empty($watch_store_content_pages) ) :
              $args = array(
                'post_type' => 'page',
                'post__in' => $watch_store_content_pages,
                'orderby' => 'post__in'
              );
              $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
          ?>     
          <div class="carousel-inner" role="listbox">
            <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
              <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
                  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a>
                  <div class="slider-content">
                    <div class="carousel-caption">
                      <div class="inner_carousel">
                        <h1><?php the_title(); ?></h1>
                        <p class="my-2"><?php $excerpt = get_the_excerpt(); echo esc_html( watch_store_string_limit_words( $excerpt,12 ) ); ?></p>
                        <div class="read-btn mt-4">
                          <a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'Read More', 'watch-store' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Read More', 'watch-store' );?></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            <?php $i++; endwhile; 
            wp_reset_postdata();?>
          </div>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
          endif;?>
          <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span><span class="screen-reader-text"><?php esc_html_e( 'Previous', 'watch-store' );?></span>
          </a>
          <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span><span class="screen-reader-text"><?php esc_html_e( 'Next', 'watch-store' );?></span>
          </a>
        </div>   
        <div class="clearfix"></div>
      </section>
    <?php }?>
  <?php do_action( 'watch_store_below_slider' ); ?>

  <?php if( get_theme_mod('watch_store_bestseller_section_text') != '' || get_theme_mod('watch_store_bestseller_section_title') != '' || get_theme_mod('watch_store_bestseller_products') != ''){ ?>
    <section id="best-seller" class="text-center py-5">
      <div class="container">     
        <div class="bestseller-head mb-5">
          <?php if( get_theme_mod('watch_store_features_title') != ''){ ?>
            <h3 class="text-center"><?php echo esc_html(get_theme_mod('watch_store_features_title')); ?></h3>
          <?php }?>
          <?php if( get_theme_mod('watch_store_bestseller_section_text') != ''){ ?>
            <p class="section-text text-center"><?php echo esc_html(get_theme_mod('watch_store_bestseller_section_text')); ?></p>
          <?php }?>
        </div>
        <?php if(class_exists( 'WooCommerce' )){?> 
          <?php $watch_store_content_pages = array();
          $mod = intval( get_theme_mod( 'watch_store_bestseller_products'));
          if ( 'page-none-selected' != $mod ) {
            $watch_store_content_pages[] = $mod;
          }
          if( !empty($watch_store_content_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $watch_store_content_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="box-image">
                  <?php the_content(); ?>
                </div>
              <?php endwhile; ?>
            <?php else : 
              wp_reset_postdata();?>
              <div class="no-postfound"></div>
            <?php endif;
          endif;?>
          <div class="clearfix"></div>
        <?php } ?>
      </div>
    </section>
  <?php }?>
  <?php do_action( 'watch_store_below_best_sellers' ); ?>

  <div class="container entry-content">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>
<?php get_footer(); ?>