<?php

namespace EtceteraRestAPI;

class EditImmovable
{
    public static $editParams = '';

    public static function process()
    {

        if (self::validateRequest()){
            $immovable = new Immovable();

            $posts = $immovable->getFromDB(self::$editParams['post_id'], IMMOVABLES_POST_ID);

            if (!empty($posts)){

                foreach ($posts as $post) {
                    $postID = $post->id;

                    //prepare correct parameter for ACF
                    $correctParameterName = $immovable->getCorrectParameterName(self::$editParams['parameter']);

                    //updating post ACF, post title, current object
                    update_field($correctParameterName, self::$editParams['new_value'], $postID);

                    if (self::$editParams['parameter'] == IMMOVABLES_NAME) {
                        wp_update_post(
                            array(
                                'ID' => $postID,
                                'post_title' => self::$editParams['new_value']
                            )
                        );
                    }

                    $updatedImmovable = get_fields($postID);
                }

                return json_encode(
                    array(
                        'message' => 'Post parameter was updated',
                        'code' => 200,
                        'post' => $updatedImmovable,
                    )
                    ,  JSON_UNESCAPED_UNICODE
                );
            }
        };

        return json_encode(
            array(
                'message' => 'Post not found or wrong data for updating. Try to use other value of parameter',
                'code' => 200
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

        $editParams = '';

        if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
            parse_str(file_get_contents("php://input"),$editParams);
        }

        if (empty($editParams['parameter'] )
            || empty($editParams['new_value'])
            || empty($editParams['post_id'])
            || !in_array($editParams['parameter'], $parametersArray)
        ){
           return  false;
        }

        self::$editParams = $editParams;

        return true;
    }
}