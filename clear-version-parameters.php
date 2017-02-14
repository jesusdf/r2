<?php

// ============ removing inbuilt WP version meta-tags ===========  http://stackoverflow.com/q/16335347/2377343  ========== //
  //if included in wp_head
    add_action( 'after_setup_theme', 'my_wp_version_remover' ); 
    function my_wp_version_remover(){
        remove_action('wp_head', 'wp_generator');   //remove inbuilt version
        remove_action('wp_head', 'woo_version');    //remove Woo-version (in case someone uses that)
    }
  //clean all responses from VERSION GENERATOR
    add_filter('the_generator',             'rm_generator_filter'); 
    add_filter('get_the_generator_html',    'rm_generator_filter');
    add_filter('get_the_generator_xhtml',   'rm_generator_filter');
    add_filter('get_the_generator_atom',    'rm_generator_filter');
    add_filter('get_the_generator_rss2',    'rm_generator_filter');
    add_filter('get_the_generator_comment', 'rm_generator_filter');
    add_filter('get_the_generator_export',  'rm_generator_filter');
    add_filter('wf_disable_generator_tags', 'rm_generator_filter');
                                    function rm_generator_filter() {return '';}
  // Hide "?vers=XXXXX" strings from scripts and styles  ( https://premium.wpmudev.org/blog/how-to-hide-your-wordpress-version-number/ )
    add_filter( 'script_loader_src', 'url_remove_wp_version_strings' );
    add_filter( 'style_loader_src', 'url_remove_wp_version_strings' );
    function url_remove_wp_version_strings( $src ) {   global $wp_version;
        parse_str(parse_url($src, PHP_URL_QUERY), $query);
        if ( !empty($query['ver']) ) { $src = remove_query_arg('ver', $src); }   return $src;
    }
// ========================================================== //

?>
