<?php

namespace EtceteraRestAPI;

use \Exception;

class Immovable
{
    const STRING_RULE = '/^[0-9A-Za-zА-Яa-яІіЇїєЄє \-\.]+$/';
    const FLOORS_NUMBER = '/^[1-9]|1[0-9]|20$/';
    const ROOMS_NUMBER = '/^[1-9]|10$/';

    const ECOLOGY_NUMBER = '/^[1-5]$/';
    const IMMOVABLE_TYPE = array(
        'панель',
        'цегла',
        'піноблок',
        'panel',
        'block'
    );
    const ADDITIONAL_OPTIONS = array(
        'так',
        'ні',
        'yes',
        'no'
    );
    const URL_RULE = '/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)/';

    public $buildingName = '';
    public $coordinates = '';
    public $floorsNumber = '';
    public $buildType = '';
    public $ecology = 1;

    public $image = '';

    public $square = '';
    public $roomsNumber = '';
    public $porch = '';
    public $bathroom = '';
    public $roomImage = '';

    public function __construct()
    {
    }

    public function init($buildingName, $coordinates, $floorsNumber, $buildType, $ecology, $image, $square, $roomsNumber, $porch, $bathroom, $roomImage)
    {

        if (preg_match(self::STRING_RULE, $buildingName)
            && preg_match(self::STRING_RULE, $coordinates)
            && preg_match(self::FLOORS_NUMBER, $floorsNumber)
            && in_array($buildType, self::IMMOVABLE_TYPE)
            && preg_match(self::ECOLOGY_NUMBER, $ecology)
            && preg_match(self::URL_RULE, $image)
            && preg_match(self::STRING_RULE, $square)
            && preg_match(self::ROOMS_NUMBER, $roomsNumber)
            && in_array($porch, self::ADDITIONAL_OPTIONS)
            && in_array($bathroom, self::ADDITIONAL_OPTIONS)
            && preg_match(self::URL_RULE, $roomImage)
        ) {
            $this->buildingName = trim($buildingName);
            $this->coordinates = trim($coordinates);
            $this->floorsNumber = trim($floorsNumber);
            $this->buildType = trim($buildType);
            $this->ecology = trim($ecology);
            $this->image = trim($image);
            $this->square = trim($square);
            $this->roomsNumber = trim($roomsNumber);
            $this->bathroom = trim($bathroom);
            $this->porch = trim($porch);
            $this->roomImage = trim($roomImage);

            return true;
        }

        return false;
    }

    public function getFromDB($parameterValue = '', $parameterName = '')
    {
        global $wpdb;

         if ($parameterName === IMMOVABLES_POST_ID) {
            return $wpdb->get_results(
                "SELECT DISTINCT ID as id"
                . " FROM $wpdb->posts"
                . " WHERE ID = '" . $parameterValue . "'"
                . " AND post_status = 'publish'",
                OBJECT_K
            );
        } else if (preg_match(self::STRING_RULE, $parameterValue)) {
            return  $wpdb->get_results(
                "SELECT post_id as id"
                . " FROM $wpdb->postmeta"
                . " WHERE meta_key = '" . $this->getCorrectParameterName($parameterName) . "'"
                . " AND meta_value = '" . $parameterValue . "'"
                , OBJECT_K
            );
        } else if ($parameterValue == '' && $parameterName == '') {
            return  $wpdb->get_results(
                "SELECT DISTINCT ID as id"
                . " FROM $wpdb->posts"
                . " WHERE post_type = '" . IMMOVABLES . "'"
                . " AND post_status = 'publish'"
                , OBJECT_K
            );
        }

        return  false;

    }

    public function getCorrectParameterName($parameterName)
    {
        if (in_array($parameterName, array(
            IMMOVABLES_SQUARE,
            IMMOVABLES_ROOMS_NUMBER,
            IMMOVABLES_PORCH,
            IMMOVABLES_BATHROOM,
            IMMOVABLES_ROOM_IMAGE
        ))){
            return 'apartment_' . $parameterName;
        };

        return $parameterName;
    }
}