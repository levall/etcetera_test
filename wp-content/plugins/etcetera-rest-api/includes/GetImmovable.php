<?php

namespace EtceteraRestAPI;

class GetImmovable
{
    public static function process()
    {
        $immovable = new Immovable();

        if (empty($_GET['parameter'] )
            || empty($_GET['value'])
        ){
            $immovableObjects = $immovable->getFromDB();

        } else {
            $immovableObjects = $immovable->getFromDB($_GET['value'], $_GET['parameter']);
        };


        //var_dump($immovableObjects);
        if (!empty($immovableObjects)){
            foreach ($immovableObjects as $index => $immovableObject){
                 $immovableObjects[$index]->data = get_fields($immovableObject->id);
            }

            return json_encode($immovableObjects,  JSON_UNESCAPED_UNICODE );
        }

        return json_encode(
            array(
                'message' => 'Data wrong. Please fix them!!! :)',
                'code' => 404
            )
            ,  JSON_UNESCAPED_UNICODE
        );
    }


    private static function validateRequest()
    {
        $parametersArray = array(
            IMMOVABLES_NAME,
            IMMOVABLES_COORDINATES,
            IMMOVABLES_FLOORS_NUMBER ,
            IMMOVABLES_TYPE,
            IMMOVABLES_ECOLOGY,
            IMMOVABLES_IMAGE,
            IMMOVABLES_SQUARE,
            IMMOVABLES_ROOMS_NUMBER,
            IMMOVABLES_PORCH,
            IMMOVABLES_BATHROOM,
            IMMOVABLES_ROOM_IMAGE
        );

        if (empty($_GET['parameter'] )
            || empty($_GET['value'])
            || !in_array($_GET['parameter'], $parametersArray)
        ){


        }

        return true;
    }
}