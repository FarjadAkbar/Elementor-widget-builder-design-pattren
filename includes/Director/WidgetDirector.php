<?php

namespace BuilderWidgets\Director;

use BuilderWidgets\Builder\WidgetBuilder;

class WidgetDirector
{
    private $builder;

    public function set_builder(WidgetBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function build_cardbox_widget()
    {
        $this->builder->create_widget('CardBox');
        $this->builder->add_title_control();
        $this->builder->add_description_control();
        $this->builder->set_icon('eicon-card');
        $this->builder->set_category('general');
    }

    public function build_tab_widget()
    {
        $this->builder->create_widget('Tab');
        // $this->builder->add_tab_control();
        $this->builder->set_icon('eicon-tabs');
        $this->builder->set_category('basic');
    }
}
?>
