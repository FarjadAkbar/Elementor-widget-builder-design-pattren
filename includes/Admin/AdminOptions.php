<?php

namespace BuilderWidgets\Admin;

class AdminOptions
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_filter( 'plugin_row_meta', [$this, 'add_plugin_row_meta'], 10, 2);
    }

    public function add_admin_menu()
    {
        add_menu_page(
            'Elementor Job Posting Translation',
            'Elementor Job Posting',
            'manage_options',
            'job-posting-settings',
            [$this, 'render_admin_page'],
            'dashicons-admin-generic'
        );
    }

    public function add_plugin_row_meta($links, $file) {    
        if (plugin_basename(__FILE__) == $file) {
            $row_meta = array(
                'Translation' => '<a href="' . admin_url('options-general.php?page=job-posting-settings') . '" target="_blank" aria-label="' . esc_attr__('Plugin Additional Links', 'elementor-job-posting') . '">' . esc_html__('Translation', 'elementor-job-posting') . '</a>'
            );
            return array_merge($links, $row_meta);
        }
        return $links;
    }    

    public function register_settings()
    {
        register_setting('elementor_widgets_settings', 'elementor_widgets_option');
    }

    public function render_admin_page()
    {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Elementor Job Posting Translation', 'my-elementor-widgets'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('elementor_widgets_settings');
                do_settings_sections('elementor_widgets_settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
?>
