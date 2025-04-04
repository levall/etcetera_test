<?php
namespace EtceteraTypes;

class FiltersWidget extends \WP_Widget
{
    function __construct() {
        parent::__construct(
            'etcetera_filter_widget', // Base ID
            'Фільтр Об\'ектів нерухомості', // Name
            array('description' => 'Фільтрація для обектів нерухомості за параметрами') // Args
        );
    }
    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = apply_filters('widget_title', $instance['title']);
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        Filters::showWidgetFilters(); // Customize this content

        echo $args['after_widget'];
    }
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('New title', 'text_domain');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}