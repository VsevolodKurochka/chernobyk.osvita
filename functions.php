<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

require get_template_directory() . '/tgm/connect.php';
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('show_admin_bar', '__return_false');

function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];

        if ( $script->deps ) { // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}
Timber::$dirname = array( 'templates', 'views' );
Timber::$autoescape = false;

class StarterSite extends Timber\Site {
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );

        $this->add_options_page();
        $this->generate_menu();
        add_action( 'wp_footer', array( $this, 'register_scripts' ) );
        add_filter('upload_mimes', array($this, 'cc_mime_types'), 1, 1);

		parent::__construct();
	}

	public function register_post_types() {
        register_post_type('reviews', array(
            'label'  => null,
            'labels' => array(
                'name'               => 'Отзывы', // основное название для типа записи
                'singular_name'      => 'Отзывы', // название для одной записи этого типа
                'add_new'            => 'Добавить отзыв', // для добавления новой записи
                'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
                'new_item'           => 'Новый отзыв', // текст новой записи
                'view_item'          => 'Смотреть отзыв', // для просмотра записи этого типа.
                'search_items'       => 'Искать отзыв', // для поиска по этим типам записи
                'not_found'          => 'Не найдено отзывов', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                'parent_item_colon'  => '', // для родителей (у древовидных типов)
                'menu_name'          => 'Отзывы', // название меню
            ),
            'description'         => '',
            'public'              => true,
            'hierarchical'        => false,
            'supports'            => array('title'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies'          => array(),
            'has_archive'         => true,
            'rewrite'             => true,
            'query_var'           => true
        ) );
	}

	public function register_taxonomies() {

	}

	public function add_to_context( $context ) {
        $context['menu'] = new Timber\Menu('menu-1');
		$context['site']  = $this;
        $context['options'] = get_fields('option');
		return $context;
	}

	public function theme_supports() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support('html5', array('comment-form', 'comment-list', 'gallery', 'caption'));
		add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio',));
		add_theme_support( 'menus' );
	}

    function register_scripts() {
        wp_enqueue_style( 'css-style', get_stylesheet_uri() );
        wp_enqueue_style( 'css-main', get_template_directory_uri() . '/static/assets/build/css/style.min.css' );
        wp_enqueue_script( 'js-jquery', get_template_directory_uri() . '/static/assets/build/js/jquery.min.js', array(), '20151215', true );
        wp_enqueue_script( 'js-jquery-main', get_template_directory_uri() . '/static/assets/build/js/jquery.main.js', array(), '20151215', true );
        wp_enqueue_script( 'js-vanilla', get_template_directory_uri() . '/static/assets/build/js/vanilla.js', array(), '20151215', true );
    }

    function add_options_page() {
        acf_add_options_page();
    }

    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['pdf'] = 'application/pdf';
        return $mimes;
    }

    function generate_menu() {
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Меню в шапке', 'osvitamarket' ),
        ) );
    }
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		return $twig;
	}

}

new StarterSite();

add_action( 'wp_footer', 'mycustom_wp_footer' );
  
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    $('#modal-form').removeClass('modal_showing_in');
    $('#modal-thx').addClass('modal_showing_in');
}, false );
</script>
<?php
}

function cf7_extra_fields_func( $atts ) {
    $html = '';
    $html .= '<input type="hidden" name="page-title" value="'.get_the_title().'">';
    $html .= '<input type="hidden" name="page-url" value="'.get_the_permalink().'">';
    return $html;
}

add_shortcode( 'cf7_extra_fields', 'cf7_extra_fields_func' );







