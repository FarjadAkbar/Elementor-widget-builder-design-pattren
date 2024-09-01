<?php

namespace BuilderWidgets\Builder;

use BuilderWidgets\Widgets\CardBoxWidget;
use BuilderWidgets\Widgets\TabWidget;

class WidgetBuilder
{
    private $widget;

    public function create_widget($type)
    {
        switch ($type) {
            case 'CardBox':
                $this->widget = new CardBoxWidget();
                break;
            case 'Tab':
                $this->widget = new TabWidget();
                break;
        }
    }

    public function add_title_control()
    {
        $this->widget->tab_control('title', [
            'label' => __('Title', 'my-elementor-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Default Title', 'my-elementor-widgets'),
        ]);
    }

    public function add_description_control()
    {
        $this->widget->tab_control('description', [
            'label' => __('Description', 'my-elementor-widgets'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Default Description', 'my-elementor-widgets'),
        ]);
    }

    public function add_tab_control()
    {
        $this->widget->add_control('tabs', [
            'label' => __('Tabs', 'my-elementor-widgets'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [
                [
                    'name' => 'tab_title',
                    'label' => __('Tab Title', 'my-elementor-widgets'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __('Tab Title', 'my-elementor-widgets'),
                ],
            ],
        ]);
    }

    public function set_icon($icon)
    {
        $this->widget->get_icon($icon);
    }

    public function set_category($category)
    {
        $this->widget->get_categories($category);
    }

    public function get_widget()
    {
        return $this->widget;
    }
}
?>
