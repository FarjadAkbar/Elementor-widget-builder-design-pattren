<?php

namespace BuilderWidgets\Widgets;

use Elementor\Widget_Base;

class CardBoxWidget extends Widget_Base
{
    public function get_name()
    {
        return 'cardbox_widget';
    }

    public function get_title()
    {
        return __('CardBox Widget', 'my-elementor-widgets');
    }

    public function get_icon()
    {
        return $this->icon ?? 'eicon-code';
    }

    public function get_categories()
    {
        return [$this->category ?? 'general'];
    }

    protected function register_controls()
    {
        // Controls are registered via the builder
        $this->tab_control($this->control_id, $this->control_args);
    }

    public function tab_control($control_id, $control_args)
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
        echo '<h2>' . esc_html($settings['title']) . '</h2>';
        echo '<p>' . esc_html($settings['description']) . '</p>';
    }
}
?>
