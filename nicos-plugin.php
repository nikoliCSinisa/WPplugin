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
    function __construct(){
        add_action( 'init', array( $this, 'custom_post_type') );
    }

    function activate(){
        //genrated CPT
        $this->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate(){
         // flush rewrite rules
         flush_rewrite_rules();
    }

    function custom_post_type(){
        register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
    }

}
   
if ( class_exists( 'NicosPlugin' ) ){
    $nicosPlugin = new NicosPlugin();
}

// activation
register_activation_hook( __FILE__, array( $nicosPlugin, 'activate') );



// deactivation
register_deactivation_hook( __FILE__, array( $nicosPlugin, 'deactivate') );



