<?php

namespace BuilderWidgets\Widgets;

use Elementor\Widget_Base;

class TabWidget extends Widget_Base
{
    public function get_name()
    {
        return 'tab_widget';
    }

    public function get_title()
    {
        return __('Tab Widget', 'my-elementor-widgets');
    }

    public function get_icon()
    {
        return $this->icon ?? 'eicon-tabs';
    }

    public function get_categories()
    {
        return [$this->category ?? 'basic'];
    }

    protected function _register_controls()
    {
        // Controls are registered via the builder
    }

    public function add_control($control_id, $control_args)
    {
        $this->start_controls_section(
            $control_id . '_section',
            [
                'label' => $control_args['label'],
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control($control_id, $control_args);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        foreach ($settings['tabs'] as $tab) {
            echo '<h3>' . esc_html($tab['tab_title']) . '</h3>';
        }
    }
}
?>
