<?php

namespace EtceteraRestAPI;

class RegisterEndpoints
{
    public static function addNewImmovable()
    {
        register_rest_route(
            'etcetera/v2',
            '/add-new-immovable',
            array(
                'methods' => \WP_REST_Server::CREATABLE,
                'callback' => ['EtceteraRestAPI\AddNewImmovable', 'process'],
            )
        );
    }

    public static function getExisingBuild()
    {
        register_rest_route(
            'etcetera/v2',
            '/get-immovable',
            array(
                'methods' => \WP_REST_Server::READABLE,
                'callback' => ['EtceteraRestAPI\GetImmovable', 'process'],
            )
        );
    }

    public static function deleteExistingBuild()
    {
        register_rest_route(
            'etcetera/v2',
            '/delete-immovable',
            array(
                'methods' => \WP_REST_Server::DELETABLE,
                'callback' => ['EtceteraRestAPI\DeleteImmovable', 'process'],
            )
        );
    }

    public static function updateBuild()
    {
        register_rest_route(
            'etcetera/v2',
            '/edit-immovable',
            array(
                'methods' => \WP_REST_Server::EDITABLE,
                'callback' => ['EtceteraRestAPI\EditImmovable', 'process'],
            )
        );
    }

    public static function parseXML()
    {

    }

    public static function init()
    {
        add_action( 'rest_api_init', array('EtceteraRestAPI\RegisterEndpoints', 'getExisingBuild'));
        add_action( 'rest_api_init', array('EtceteraRestAPI\RegisterEndpoints', 'deleteExistingBuild'));
        add_action( 'rest_api_init', array('EtceteraRestAPI\RegisterEndpoints', 'addNewImmovable'));
        add_action( 'rest_api_init', array('EtceteraRestAPI\RegisterEndpoints', 'updateBuild'));
    }
}