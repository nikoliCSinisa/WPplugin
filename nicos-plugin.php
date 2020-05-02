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
if ( !class_exists( 'NicosPlugin' ) ){

    class NicosPlugin
    {

        public $plugin;

        function __construct(){
            $this->plugin = plugin_basename( __FILE__ );
        }

        function register(){
            //Register plugin
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

            //Creating admin menu page for plugin settings
            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

            //Creating plugin link for settings
            add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
        }

        public function settings_link( $links ){
            // Add custom settings link to array of WP links
            $settings_link = '<a href="admin.php?page=nicos_plugin">Settings</a>';
            array_push( $links, $settings_link );
            return $links;
        }

        public function add_admin_pages(){
            add_menu_page( 'Nicos Plugin', 'Nicos Settings', 'manage_options', 'nicos_plugin', array( $this, 'admin_index' ), 'dashicons-plugins-checked', 110 );
        }

        public function admin_index(){
            // Add HTML template for plugin settings page in admin panel
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
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

        function activate(){
            //Method 1: Call a static method without initalize class first
            require_once plugin_dir_path( __FILE__ ) . 'inc/nicos-plugin-activate.php';
            NicosPluginActivate::activate();
        }

    }

    $nicosPlugin = new NicosPlugin();
    $nicosPlugin->register(); //After initialize class call a method for plugin registration


        // activation
        register_activation_hook( __FILE__, array( $nicosPlugin, 'activate') );

        // deactivation
        //Method2: Call a method from deactivation class through WP hook
        require_once plugin_dir_path( __FILE__ ) . 'inc/nicos-plugin-deactivate.php';
        register_deactivation_hook( __FILE__, array( 'NicosPluginDeactivate', 'deactivate') );

}


