<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
//use EtceteraRestAPI\AddNewImmovable;
//use EtceteraRestAPI\Immovable;

defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );

//just for try to do it

//$immovable = new Immovable();
//$immovable->buildingName = 'NEW Immovable build';
//$immovable->roomImage = 'https://webmotor.ru/gallery/3d-plans/all_itog_new.png';
//$immovable->image = 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgJera8hj7_0s4TKsiSp40tpaXlq6whMJWXc7beYfDJxqKLb-CRV-0oA9PNEjNMwB69OAjEgVzYp76e0s3AIpLFba7FHoSyh-DSx7QI71myWs2euOGyNSwtgGR9ka4s33-NCyoDhP4EKps/s1600/07_2.jpg';
//$immovable->roomsNumber = 7;
//$immovable->floorsNumber = 7;
//$immovable->bathroom = 'так';
//$immovable->coordinates = 'так';
//$immovable->square = '1000м2';
//$immovable->porch = 'ні';
//$immovable->ecology = 4;
//$immovable->buildType = 'цегла';

//AddNewImmovable::createNewImmovable($immovable);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar">

		<a class="skip-link <?php echo understrap_get_screen_reader_class( true ); ?>" href="#content">
			<?php esc_html_e( 'Skip to content', 'understrap' ); ?>
		</a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>

	</header><!-- #wrapper-navbar -->
