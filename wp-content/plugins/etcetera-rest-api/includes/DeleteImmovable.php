<?php

namespace EtceteraRestAPI;

class DeleteImmovable
{
    public static $deleteParams = '';

    public static function process()
    {

        if (self::validateRequest()) {
            $immovable = new Immovable();
            $posts = $immovable->getFromDB(self::$deleteParams['value'], self::$deleteParams['parameter']);
            $response = [];

            if (!empty($posts)) {

                foreach ($posts as $post){


                    $postID = $post->id;

                    acf_delete_metadata($postID, IMMOVABLES_NAME);
                    acf_delete_metadata($postID, IMMOVABLES_COORDINATES);
                    acf_delete_metadata($postID, IMMOVABLES_FLOORS_NUMBER);
                    acf_delete_metadata($postID, IMMOVABLES_TYPE);
                    acf_delete_metadata($postID, IMMOVABLES_ECOLOGY);
                    acf_delete_metadata($postID, IMMOVABLES_IMAGE);
                    acf_delete_metadata($postID, 'apartment_' . IMMOVABLES_SQUARE);
                    acf_delete_metadata($postID, 'apartment_' . IMMOVABLES_ROOMS_NUMBER);
                    acf_delete_metadata($postID, 'apartment_' . IMMOVABLES_PORCH);
                    acf_delete_metadata($postID, 'apartment_' . IMMOVABLES_BATHROOM);
                    acf_delete_metadata($postID, 'apartment_' . IMMOVABLES_ROOM_IMAGE);

                    $removeResponse = wp_delete_post($postID);

                    $response[] = json_encode(
                        array(
                            'message' => 'Post removed',
                            'code' => 200,
                            'data' => $removeResponse
                        )
                        , JSON_UNESCAPED_UNICODE);

                }

                return $response;
            }
        }


        return json_encode(
            array(
                'message' => 'Post not found. Try to use other value of parameter',
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
            IMMOVABLES_ROOM_IMAGE,
            IMMOVABLES_POST_ID
        );

        $deleteParams = '';

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            parse_str(file_get_contents("php://input"),$deleteParams);
        }

        if (empty($deleteParams['parameter'] )
            || empty($deleteParams['value'])
            || !in_array($deleteParams['parameter'], $parametersArray)
        ){
           return false;
        }

        $immovable = new Immovable();

        self::$deleteParams = $deleteParams;

        return true;
    }
}