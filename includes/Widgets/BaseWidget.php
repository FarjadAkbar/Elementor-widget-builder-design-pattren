<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

abstract class Base_Widget extends Widget_Base {

    public function get_script_depends() {
        return []; // Add your script handles here
    }

    public function get_style_depends() {
        return []; // Add your style handles here
    }
}
?>
