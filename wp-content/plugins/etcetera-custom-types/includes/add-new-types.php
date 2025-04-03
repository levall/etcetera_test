<?php

namespace EtceteraTypes;

class AddNewTypes
{
    public static function customPosts()
    {
        $args = array(
            'labels' => array(
                'menu_name' => "Об'єкти нерухомості",
                'name'      => "Об'єкт нерухомості",

            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-admin-multisite',
            'show_in_rest' => true
        );

        register_post_type( 'immovables', $args );
    }

    public static function customTaxonomies()
    {

        $labels = array(
            'name'              => 'Район',
            'singular_name'     => 'Район',
        );
        $args   = array(
            'hierarchical'      => true, // make it hierarchical (like categories)
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => 'district' ],
        );

        register_taxonomy( 'district', [ 'immovables' ], $args );
    }

}