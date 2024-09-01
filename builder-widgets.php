<?php
/*
Plugin Name: Builder Widgets
Description: A plugin to add custom Elementor widgets with the Builder pattern.
Version: 1.0
Author: Farjad Akbar
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


// Load Composer autoload
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

new \BuilderWidgets\Admin\AdminOptions();

// // Initialize GitHub Updater
// new \BuilderWidgets\Updater\GitHubUpdater(
//     __FILE__,
//     'farjadakbar4',
//     'http://github.com/FarjadAkbar'
// );

// Register Elementor widgets
add_action('elementor/widgets/register', function ($widgets_manager) {
    $director = new \BuilderWidgets\Director\WidgetDirector();
    $builder = new \BuilderWidgets\Builder\WidgetBuilder();

    // Register CardBox Widget
    $director->set_builder($builder);
    $director->build_cardbox_widget();
    $widgets_manager->register($builder->get_widget());

    // // Register Tab Widget
    // $director->build_tab_widget();
    // $widgets_manager->register($builder->get_widget());
});