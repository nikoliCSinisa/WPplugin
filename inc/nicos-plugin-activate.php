<?php
/**
 * @package NicosPlugin
 */

 class NicosPluginActivate
 {
     public static function activate(){
         flush_rewrite_rules();
     }
 }