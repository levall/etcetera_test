<?php

namespace EtceteraTypes;
class ChangeOrder{
    public static function init()
    {
        add_action('pre_get_posts', array( 'EtceteraTypes\ChangeOrder', 'filterOrdering'), 10, 1);
    }

    public static function filterOrdering($query){

        if ($query->get('post_type') == 'immovables'){
            $query->set('orderby', 'meta_value_num');
            $query->set('meta_key', 'ecology');
            $query->set('order', 'ASC');
        }
    }
}