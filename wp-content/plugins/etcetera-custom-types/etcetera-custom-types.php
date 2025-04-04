<?php

/*
 * @package       Etcetera Custom Types
 * @author        Leonid Lukianov
 *
 * @wordpress-plugin
 * Plugin Name:       Etcetera Custom Types
 * Description:       Test purpose. Provide new custom types and taxonomies
 * Version:           0.0.1
 * Author:            Leonid Lukianov
*/

namespace EtceteraTypes;

class EtceteraCustomTypes
{
    public function __construct()
    {
        // Do nothing.
    }

    public function init()
    {
        $this->define('IMMOVABLES', 'immovables');

        // Include utility functions.
        include_once __DIR__ . '/includes/add-new-types.php';
        include_once __DIR__ . '/includes/filters.php';
        include_once __DIR__ . '/includes/FiltersWidget.php';
        include_once __DIR__ . '/includes/Ajax.php';
        include_once __DIR__ . '/includes/ChangeOrder.php';

        wp_enqueue_style( 'etcetera_css',  '/wp-content/plugins/etcetera-custom-types/assets/css/styles.css' );
        wp_enqueue_script( 'etcetera_js', '/wp-content/plugins/etcetera-custom-types/assets/js/main.js','', '1.1', true );

        add_action('init', array('EtceteraTypes\AddNewTypes', 'customTaxonomies'));
        add_action('init', array('EtceteraTypes\AddNewTypes', 'customPosts'));

        Ajax::init();
        Filters::registerHooks();
        ChangeOrder::init();
    }

    public function define( $name, $value = true ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }
}

function etceteraCustomTypes() {
    global $etceteraCustomTypes;

    // Instantiate only once.
    if ( ! isset( $etceteraCustomTypes ) ) {
        $etceteraCustomTypes = new EtceteraCustomTypes();
        $etceteraCustomTypes->init();
    }
    return $etceteraCustomTypes;
}

etceteraCustomTypes();