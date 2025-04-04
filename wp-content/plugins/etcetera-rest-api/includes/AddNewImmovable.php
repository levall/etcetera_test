<?php

namespace EtceteraRestAPI;

class AddNewImmovable
{
    public static function process()
    {

        if (self::validateRequest()){

            $immovable = new Immovable();

            if ($immovable->init(
                $_POST[IMMOVABLES_NAME],
                $_POST[IMMOVABLES_COORDINATES],
                $_POST[IMMOVABLES_FLOORS_NUMBER],
                $_POST[IMMOVABLES_TYPE],
                $_POST[IMMOVABLES_ECOLOGY],
                $_POST[IMMOVABLES_IMAGE],
                $_POST[IMMOVABLES_SQUARE],
                $_POST[IMMOVABLES_ROOMS_NUMBER],
                $_POST[IMMOVABLES_PORCH],
                $_POST[IMMOVABLES_BATHROOM],
                $_POST[IMMOVABLES_ROOM_IMAGE]
            )){
                $result = self::createNewImmovable($immovable);

                if ( !$result) {
                    return json_encode(
                        array(
                            'message' => 'Immovable with this NAME exist',
                            'code' => 200
                        ),  JSON_UNESCAPED_UNICODE );

                } else if (is_wp_error($result)){
                    return json_encode(
                        array(
                            'message' => 'Data wrong. Please fix theme',
                            'code' => 404
                        ),  JSON_UNESCAPED_UNICODE );
                };
            }
        };

        return json_encode(
            array(
                'message' => "Immovable was added correctly",
                'code' => 200
            ),  JSON_UNESCAPED_UNICODE );

    }

    /**
     * @param $immovable Immovable
     * @return void
     */
    public static function createNewImmovable($immovable)
    {

        if (post_type_exists(IMMOVABLES)) {

            $postArray = array(
                'post_type'   => IMMOVABLES,
                'post_title'  => $immovable->buildingName,
                'post_status' => 'publish'
            );

            //just check if record with this name have already exist
            if (empty($immovable->getFromDB($immovable->buildingName, IMMOVABLES_NAME))){

                $postID = wp_insert_post($postArray);
                $buildImageID =  self::loadImage($postID, $immovable->image);
                $roomImageID =  self::loadImage($postID, $immovable->roomImage);

                if (is_wp_error($buildImageID)  || is_wp_error($roomImageID)){
                    return new \WP_Error( 'an_error_code', 'Зображення не вірні', [ 'status' => 404 ] );
                }

                update_field(IMMOVABLES_NAME, $immovable->buildingName, $postID);
                update_field(IMMOVABLES_COORDINATES, $immovable->coordinates, $postID);
                update_field(IMMOVABLES_FLOORS_NUMBER, $immovable->floorsNumber, $postID);
                update_field(IMMOVABLES_TYPE, $immovable->buildType, $postID);
                update_field(IMMOVABLES_ECOLOGY, $immovable->ecology, $postID);
                update_field(IMMOVABLES_IMAGE, $buildImageID, $postID);
                update_field('apartment_' . IMMOVABLES_SQUARE, $immovable->square, $postID);
                update_field('apartment_' . IMMOVABLES_ROOMS_NUMBER, $immovable->roomsNumber, $postID);
                update_field('apartment_' . IMMOVABLES_PORCH, $immovable->porch, $postID);
                update_field('apartment_' . IMMOVABLES_BATHROOM, $immovable->bathroom, $postID);
                update_field('apartment_' . IMMOVABLES_ROOM_IMAGE, $roomImageID, $postID);
            }

            return false;
        }
    }

    private static function validateRequest()
    {
        if (empty($_POST[IMMOVABLES_NAME])
            || empty($_POST[IMMOVABLES_COORDINATES])
            || empty($_POST[IMMOVABLES_FLOORS_NUMBER])
            || empty($_POST[IMMOVABLES_TYPE])
            || empty($_POST[IMMOVABLES_ECOLOGY])
            || empty($_POST[IMMOVABLES_IMAGE])
            || empty($_POST[IMMOVABLES_SQUARE])
            || empty($_POST[IMMOVABLES_ROOMS_NUMBER])
            || empty($_POST[IMMOVABLES_PORCH])
            || empty($_POST[IMMOVABLES_BATHROOM])
            || empty($_POST[IMMOVABLES_ROOM_IMAGE])
        ){
            return false;
        }

        return true;
    }

    private static function loadImage( $post_id, $file, $desc = null ){
        global $debug;

        if( ! function_exists('media_handle_sideload') ) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
        }

        // Load file to the temporary directory
        $tmp = download_url( $file );

        if ( !is_wp_error( $tmp ) ) {
            $file_array = [
                'name' => basename($file),
                'tmp_name' => $tmp,
                'error' => 0,
                'size' => filesize($tmp),
            ];
        }

        // remove temporary file on error
        if ( is_wp_error( $tmp ) ) {
            $file_array['tmp_name'] = '';
            if( $debug ) echo "Temporary file doesn't exist! <br />";
        }

        // check the debug - if all ok.
        if( $debug ){
            echo 'File array: <br />';
            var_dump( $file_array );
            echo '<br /> Post id: ' . $post_id . '<br />';
        }

        $id = media_handle_sideload( $file_array, $post_id, $desc );

        if ( is_wp_error( $id ) ) {
            var_dump( $id->get_error_messages() );
        }

        // remove temporary file
        @unlink( $tmp );

        return $id;
    }


}