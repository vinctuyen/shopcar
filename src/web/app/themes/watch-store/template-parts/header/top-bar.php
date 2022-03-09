<?php 
/*
* Display Top Bar
*/
?>
<?php if( get_theme_mod('watch_store_show_topbar', false) != ''){ ?>
  <?php if( get_theme_mod( 'watch_store_topar_text' ) != '' || get_theme_mod( 'watch_store_call' ) != '' || get_theme_mod( 'watch_store_button_text' ) != '' || get_theme_mod( 'watch_store_button_link' ) != '' ) { ?>
    <div class="top-header py-md-1 py-3">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-5 align-self-center">
            <?php if( get_theme_mod( 'watch_store_topar_text' ) != '') { ?>
              <p class="topbar-text text-md-start text-center mb-md-0 mb-3"><?php echo esc_html( get_theme_mod('watch_store_topar_text') ); ?></p>
            <?php } ?>
          </div>
          <div class="col-lg-6 col-md-6 align-self-center">
            <div class="row">
              <div class="col-lg-9 col-md-8 align-self-center text-md-start text-center"> 
                <?php if ( get_theme_mod('watch_store_sale_text') != "" ) {?>     
                  <span class="sale-text"><?php echo esc_html( get_theme_mod('watch_store_sale_text') ); ?></span>  
                <?php }?> 
              </div>
              <div class="col-lg-3 col-md-4 sale-btn align-self-center text-md-start text-center">
                <?php if ( get_theme_mod('watch_store_sale_button_text') != "" || get_theme_mod('watch_store_sale_button_link') != "" ) {?>
                  <a href="<?php echo esc_html( get_theme_mod('watch_store_sale_button_link') ); ?>"><?php echo esc_html( get_theme_mod('watch_store_sale_button_text') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('watch_store_sale_button_text') ); ?></span></a> 
                <?php }?>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  <?php }?>
<?php }?>