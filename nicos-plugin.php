<?php
/**
 * @package NicosPlugin
 */
/*
Plugin Name: Nicos Plugin
Plugin URI: 
Description: First attempt to create custom plugin
Version: 1.0.0
Author: Sinisa "Nico" Nikolic
Author URI: http://nikolic.srb
Licence: GPLv2 or later
Text Domain: nicos-plugin
*/
/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

Copyright 2005-2015 Automattic, Inc.
*/

defined( 'ABSPATH' ) or die( 'Hey, what are You doing here? You silly human!' );

class NicosPlugin
{
     function register(){
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    protected function create_post_type(){
        add_action( 'init', array( $this, 'custom_post_type') );
    }

    function custom_post_type(){
        register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
    }

    function enqueue(){
        //Enqueue all scripts
        wp_enqueue_style( 'pluginstyle', plugins_url( '/assets/style.css', __FILE__ ) );
        wp_enqueue_script( 'pluginscript', plugins_url( '/assets/scrip.js', __FILE__ ) );
    }

}
   
if ( class_exists( 'NicosPlugin' ) ){
    $nicosPlugin = new NicosPlugin();
    $nicosPlugin->register();
}

// activation
require_once plugin_dir_path( __FILE__ ) . 'inc/nicos-plugin-activate.php';
register_activation_hook( __FILE__, array( 'NicosPluginActivate', 'activate') );

// deactivation
require_once plugin_dir_path( __FILE__ ) . 'inc/nicos-plugin-deactivate.php';
register_deactivation_hook( __FILE__, array( 'NicosPluginDeactivate', 'deactivate') );



