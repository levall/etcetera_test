<?php

/*
 * @package       Etcetera Rest Api
 * @author        Leonid Lukianov
 *
 * @wordpress-plugin
 * Plugin Name:          Etcetera Rest Api
 * Description:       Test purpose. Provide possibility to have an access to the REST API for custom posts
 * Version:           0.0.1
 * Author:            Leonid Lukianov
*/
namespace EtceteraRestAPI;

class EtceteraRestAPI
{

    public function __construct()
    {
        // Do nothing.
    }
    public function init()
    {
        // Include utility functions.
        $this->define('IMMOVABLES', 'immovables');

        $this->define('IMMOVABLES_NAME', 'build_name');
        $this->define('IMMOVABLES_COORDINATES', 'coordinates');
        $this->define('IMMOVABLES_FLOORS_NUMBER', 'floors_number');
        $this->define('IMMOVABLES_TYPE', 'build_type');
        $this->define('IMMOVABLES_ECOLOGY', 'ecology');
        $this->define('IMMOVABLES_IMAGE', 'image');
        $this->define('IMMOVABLES_SQUARE', 'square');
        $this->define('IMMOVABLES_ROOMS_NUMBER', 'rooms_number');
        $this->define('IMMOVABLES_PORCH', 'porch');
        $this->define('IMMOVABLES_BATHROOM', 'bathroom');
        $this->define('IMMOVABLES_ROOM_IMAGE', 'room_image');
        $this->define('IMMOVABLES_POST_ID', 'post_id');

        include_once __DIR__ . '/includes/RegisterEndpoints.php';
        include_once __DIR__ . '/includes/Immovable.php';
        include_once __DIR__ . '/includes/AddNewImmovable.php';
        include_once __DIR__ . '/includes/GetImmovable.php';
        include_once __DIR__ . '/includes/DeleteImmovable.php';
        include_once __DIR__ . '/includes/EditImmovable.php';

        RegisterEndpoints::init();
    }

    public function define( $name, $value = true ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }
}

function etceteraRestApi() {
    global $etceteraRestApi;

    // Instantiate only once.
    if ( ! isset( $etceteraRestApi ) ) {
        $etceteraRestApi = new EtceteraRestAPI();
        $etceteraRestApi->init();
    }
    return $etceteraRestApi;
}

// Instantiate.
etceteraRestApi();