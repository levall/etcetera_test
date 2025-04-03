<?php
/**
 * The header for our theme
 *
 */


// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">


    <header id="main_menu">
        <?php wp_page_menu( array( 'show_home' => 'Домашня' ) ); ?>
    </header>
