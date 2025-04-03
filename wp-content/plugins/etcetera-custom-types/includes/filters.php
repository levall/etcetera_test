<?php

namespace EtceteraTypes;

class Filters
{
    const FILTERS = array(
        array(
            'name' => 'Ім\'я',
            'type' => 'string',
            'possible_values' => [],
            'parameter' => 'build_name'
        ),
        array(
            'name' => 'Координати',
            'type' => 'string',
            'possible_values' => [],
            'parameter' => 'coordinates'
        ),
        array(
            'name' => 'Кількість поверхів',
            'type' => 'select',
            'possible_values' => 20,
            'parameter' => 'floors_number'
        ),
        array(
            'name' => 'Тип будівлі',
            'type' => 'radio',
            'possible_values' => ['панель', 'цегла', 'піноблок'],
            'parameter' => 'build_type'
        ),
        array(
            'name' => 'Екологічність',
            'type' => 'select',
            'possible_values' => 5,
            'parameter' => 'ecology'
        ),

        array(
            'name' => 'Площа аппартаментів',
            'type' => 'string',
            'possible_values' => [],
            'parameter' => 'appartment_square'
        ),
        array(
            'name' => 'Кількість кімнат',
            'type' => 'radio',
            'possible_values' => [1,2,3,4,5,6,7,8,9,10],
            'parameter' => 'appartment_rooms_number'
        ),
        array(
            'name' => 'Балкон',
            'type' => 'radio',
            'possible_values' => ['так','ні'],
            'parameter' => 'appartment_porch'
        ),
        array(
            'name' => 'Санвузел',
            'type' => 'radio',
            'possible_values' => ['так','ні'],
            'parameter' => 'appartment_bathroom'
        ),

    );
    public static function registerHooks()
    {
        add_shortcode('filters_block', array('EtceteraTypes\Filters', 'showShortcodeFilters'));
        add_action('widgets_init', array('EtceteraTypes\Filters', 'registerFilterWidget'));

    }

    public static function showShortcodeFilters(){
        $filtersHTML = self::renderFilters('shortcode');
        self::renderFilterTemplate('filter-block.php', $filtersHTML);
    }

    public static function showWidgetFilters(){
        $filtersHTML = self::renderFilters('widget');
        self::renderFilterTemplate('filter-widget.php', $filtersHTML);
    }

    private static function renderFilters($prefix){

        $html = "";

        foreach (self::FILTERS as $filter){
            $filter = (object)$filter;
            $filerID = $prefix. '_'  . $filter->parameter;

            $html .= '<div class="filter">';
            $html   .= '<label class="filter_name" for="' . $filerID . '">' . $filter->name . '</label>';

            switch ($filter->type){
                case "string":
                    $html   .= '<input id="' . $filerID . '" name="' . $filter->parameter
                        .  '" type="text" data-parameter="' . $filter->parameter . '">';
                    break;

                case "radio":
                    foreach ($filter->possible_values as $index => $value){
                        $html .= '<input id="' . $filerID . "_" . $index
                            . '" type="radio" name="' . $filter->parameter
                            .'" data-parameter="' . $filter->parameter . '" value="' . $value . '">';

                        $html .= '<label class="radio_filter" for="' . $filerID . "_" . $index . '">' . $value . '</label>';
                    }

                    break;

                case "select":
                    $html .= '<select id="' . $filerID . '" type="select" name="' . $filter->parameter
                        .'" data-parameter="' . $filter->parameter . '">';

                    for ($option = 0; $option <= $filter->possible_values; $option++) {
                        $html .= '<option value="' . $option .  '">' . $option .  '</option>';
                    }

                    $html .= '</select>';

                    break;
            }

            $html .= '<input type="submit" hidden></div>';
        }

        return $html;
    }

    public static function registerFilterWidget()
    {
        register_widget('EtceteraTypes\FiltersWidget');
    }

    private static function renderFilterTemplate($templateName, $filtersHtml = '')
    {
        $filePath = plugin_dir_path(__DIR__) . '/templates/' . $templateName;
        if (file_exists($filePath)) {
            require $filePath;
        }
        else {
            echo "Wrong path: " . $filePath;
        }
    }


}