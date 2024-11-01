<?php
/*
Plugin Name: WPFY FAQ Block
Plugin URI: https://akramuldev.com/plugins/wpfy-faq-block/
Description: Gutenberg FAQ Block plugin. This is a very straightforward tiny but useful plugin to add a block element that will help to create the Frequently Asked Questions (FAQ) section. It is very easy to use. After installing this plugin, a custom block item will be available, which will have a repeater pair of fields to add a question and answer. In the front end, it will generate a nice and smooth collapsible FAQ section.
Version: 1.0
Author: Akramul Hasan
Author URI: https://www.akramuldev.com
Tag: wordpress plugin, gutenberg, block, faq, frequently asked questions
Text Domain: wpfyfaq
Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit;

class WPFY_FAQ{

    function __construct(){
        add_action('init',array($this, 'adminAssets'));
    }

    function adminAssets(){
        wp_register_style('maincss', plugin_dir_url(__FILE__).'/build/style-index.css');
        wp_register_script('mainjs', plugin_dir_url(__FILE__).'/build/index.js',array('wp-blocks','wp-element','wp-editor'));
        register_block_type('wpfyfaq/wpfy-faq-block',array(
            'editor_script'=> 'mainjs',
            'editor_style'=> 'maincss',
            'render_callback' => array($this, 'theHTML')
        ) );
        
    }

    function theHTML($attributes){
        if(!is_admin()){
            wp_enqueue_script('frontendjs', plugin_dir_url(__FILE__ ).'build/frontend.js', array('wp-element'), null, true);
            wp_enqueue_style('frontendcss', plugin_dir_url(__FILE__).'build/frontend.css');
        }
        ob_start(); ?>
        <div class="wpfy-faq-update-me">
            <?php 
            echo '<pre style="display:none">';
                echo wp_json_encode($attributes);
            echo '</pre>';
            ?>
        </div>


        <?php return ob_get_clean();
        // return '<p>This is the new output form php file with sky color '.esc_attr($attributes['skyColor']).' and grass color is '.$attributes['grassColor'].'<p>';
    }

}
$wpfy_faq = new WPFY_FAQ();