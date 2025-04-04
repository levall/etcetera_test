<?php

namespace EtceteraTypes;
use WP_Query;


class Ajax
{
    public static function init()
    {
        add_action('wp_ajax_filter_immovables', array('EtceteraTypes\Ajax', 'findImmovables'));
        add_action('wp_ajax_nopriv_filter_immovables', array('EtceteraTypes\Ajax', 'findImmovables'));
    }

    public static function findImmovables()
    {

        if (array_key_exists('parameters', $_POST) && array_key_exists('paged', $_POST)) {

            $response = [];
            $parameters = json_decode( str_replace('\"', '"', $_POST['parameters']) ) ;
            $paged = $_POST['paged'];

            if (is_object($parameters)) {

                $args = array(
                    'post_type' => 'immovables',
                    'orderby' => 'date',
                    'posts_per_page' => 5,
                    'paged' =>  $paged,
                    'order' => 'DESC',

                    'meta_query' => array(
                        'relation' => 'AND',
                    ),
                );

                foreach ($parameters as $parameterName => $parameterValue) {
                    $compare = 'LIKE';

                    if ($parameterName == 'apartment_rooms_number'
                        || $parameterName == 'floors_number'
                    ){
                        $compare = '=';
                    }

                    $args['meta_query'][] = array(
                            'key' => trim($parameterName),
                            'value' => trim($parameterValue),
                            'compare' => $compare
                        );
                }

                $wp_query = new WP_Query($args);
                $html = '';

                if ($wp_query->found_posts > 0) {

                    ob_start();

                    if ($wp_query->have_posts()) {
                        $postCounter = 0;
                        echo '<div class="response flex-row">';

                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                            $immovableData = get_fields(get_the_ID());

                            echo "<div><h3>" .  get_the_title() . "</h3>";

                            echo '<div class="flex-row">';
                                echo '<section>'
                                        .'<img src="' . $immovableData['image'] . '">'
                                        .'<a сlass="immovable" href="' . get_the_permalink() . '">Детальніше</a>'
                                    .'</section>';

                            echo'</div></div>';
                            $postCounter++;
                        }

                        echo '</div>';

                        if ($wp_query->found_posts > 1) {

                            self::generatePaginationAjax($wp_query, $paged, $postCounter);

                        }

                        $html = ob_get_contents();
                        ob_end_clean();
                    }
                }

                if (empty($html)) {
                    $response['message'] = "Данних за цими параметрами не знайдено";
                    $response['success'] = false;

                    self::reply($response, 400);
                    wp_die();
                }

                $response['message'] = 'Found posts';
                $response['html'] = $html;
                $response['success'] = true;

                self::reply($response, 200);
                wp_die();
            } else {
                self::reply(['message' => 'Заданні параметри не вірні'], 400);
                wp_die();
            }
        } else {
            self::reply(['message' => 'Данних за цими параметрами не знайдено'], 400);
            wp_die();
        }
    }

    protected static function reply($data, $code = null)
    {
        if ($code) {
            http_response_code($code);
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);

        exit;
    }

    private static function generatePaginationAjax($loop, $paged, $postCounter)
    {
        $base    = "/";
        $format  = '';
        $allProducts = $loop->found_posts;

        echo '<div class="fromajax" id="filtering-nav"><div class="pagination">';

        echo paginate_links(
             array( // WPCS: XSS ok.
                'base'      => $base,
                'format'    => $format,
                'add_args'  => false,
                'current'   => max( 1, $paged ),
                'total'     => $loop->max_num_pages,
                'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
                'next_text' => is_rtl() ? '&larr;' : '&rarr;',
                'type'      => 'list',
                'end_size'  => 1,
                'mid_size'  => 1,
                'per_page'  => 1
            )
        );

        echo '</div>';
    }

}