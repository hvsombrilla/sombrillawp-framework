<?php 

include('Route/Router.php');
include('Route/RouteStore.php');
include('Route/ReverseRouter.php');
include('Route/RequestDispatcher.php');
include('Route/RouteParser.php');
include('Route/StaticRouteParser.php');
include('Route/DynamicRouteParser.php');


function sombrillawp_framework_scripts()
{
    $assets       =  get_bloginfo('template_url') . '/inc/framework/assets' ;
    $assetVersion = '1.0.1';
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_script('sombrillawp-scripts-global', $assets . '/js/global.js', [], $assetVersion);
    wp_enqueue_script('sombrillawp-scripts', $assets . '/js/core.js', ['jquery'], $assetVersion, true);
    wp_enqueue_style( 'sombrillawp_wp_admin_css',$assets . '/css/core.css' );

   // wp_enqueue_script('typerocket-editor', $assets . '/js/redactor.min.js', ['jquery'], $assetVersion, true );
}
add_action('admin_enqueue_scripts', 'sombrillawp_framework_scripts');
add_action('wp_enqueue_scripts', 'sombrillawp_framework_scripts');


spl_autoload_register(function($class) {
	if (preg_match('#SombrillaWP#', $class)) {

		$class = explode('SombrillaWP\\', $class)[1];

		include str_replace(['','\\'], '/', $class) . '.php';
	}
     
});

include('helpers.php');

 add_action( 'after_setup_theme', function () {
            do_action( 'typerocket_loaded' );
            SombrillaWP\Register\Registry::initHooks();
        } );