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
        // Include utility functions.
        include_once __DIR__ . '/includes/add-new-types.php';

        add_action('init', array('EtceteraTypes\AddNewTypes', 'customTaxonomies'));
        add_action('init', array('EtceteraTypes\AddNewTypes', 'customPosts'));
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

// Instantiate.
etceteraCustomTypes();