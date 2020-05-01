<?php
/**
 * @package NicosPlugin
 */

 class NicosPluginDeactivate
 {
     public static function deactivate(){
         flush_rewrite_rules();
     }
 }