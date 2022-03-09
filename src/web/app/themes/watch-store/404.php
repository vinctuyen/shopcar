<?php
/**
 * Display 404 page
 * @package Watch Store
 */

get_header(); ?>

<main id="main" role="main" class="main-content">
    <div class="container">
        <div class="page-content my-5">
            <h1 class="mb-2 p-0"><?php printf( '<strong>%s</strong> %s', esc_html__( '404', 'watch-store' ), esc_html__( 'Not Found', 'watch-store' ) ) ?></h1>
            <p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn', 'watch-store' ); ?></p>
            <p class="text-404"><?php esc_html_e( 'Dont worry it happens to the best of us.', 'watch-store' ); ?></p>
            <div class="read-moresec my-4">
                <a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right py-2 px-3"><?php esc_html_e( 'Return to home page', 'watch-store' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Return to home page', 'watch-store' );?></span></a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</main>

<?php get_footer(); ?>