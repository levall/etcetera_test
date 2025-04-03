<?php

class Ajax
{
    public function __construct()
    {
        add_action('wp_ajax_open_details', array('Ajax', 'openDetails'));
        add_action('wp_ajax_nopriv_open_details', array('Ajax', 'openDetails'));
    }

    public static function openDetails()
    {
        if (!array_key_exists('maf_id' ,$_POST)){
            self::reply(['message' => 'Some data missed'], 400);
        }

        $mafId = $_POST['maf_id'];
        $maf = new Maf($mafId);
        $html = '';

        ob_start();
        get_template_part('template-parts/maf', 'details', ['maf' => $maf]);
        $html .= ob_get_contents();
        ob_end_clean();

        if (empty($html)){
            self::reply(['message' => 'Some data missed'], 400);
        }

        $response['success'] = true;
        $response['html'] = $html;

        self::reply($response, 200);

        wp_die();

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

}