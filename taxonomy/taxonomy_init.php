<?php 
add_action( 'init', 'register_post_auto_portfolio', 0 );
function register_post_auto_portfolio() {
$args = array(
    'label'  => _x( 'Примеры работ', 'Post Type General Name', 'text_domain' ),
    'labels' => array(
    'name' => _x( 'Примеры работ', 'Post Type General Name', 'text_domain' ),
    'singular_name' => _x( 'Новость', 'Post Type Singular Name', 'text_domain' ),
    'add_new' => __( 'Добавить портфолио', 'text_domain' ),
    'add_new_item' => __( 'Добавить портфолио', 'text_domain' ),
    'edit_item' => __( 'Редактировать портфолио', 'text_domain' ),
    'new_item' => __( 'Новый пример', 'text_domain' ),
    'view_item' => __( 'Просмотреть пример', 'text_domain' ),
    'search_items' => __( 'Поиск портфолио', 'text_domain' ),
    'not_found' => __( 'Примеров не найдено', 'text_domain' ),
    'not_found_in_trash' => __( 'Примеров в корзине не найдено', 'text_domain' ),
    'parent_item_colon' => null,
    'all_items' => __( 'Все примеры', 'text_domain' ),
    'archives' => __( 'Архивы примеров', 'text_domain' ),
    'insert_into_item' => __( 'Вставить в пример', 'text_domain' ),
    'uploaded_to_this_item' => _x( 'Загружен для:', 'text_domain' ),
    'featured_image' => __( 'Миниатюра записи', 'text_domain' ),
    'set_featured_image' => __( 'Задать миниатюру', 'text_domain' ),
    'remove_featured_image' => __( 'Удалить миниатюру', 'text_domain' ),
    'use_featured_image' => __( 'Использовать миниатюру', 'text_domain' ),
    'menu_name' => __( 'Наши работы', 'text_domain' ),
    'name_admin_bar' => __( 'Пример', 'text_domain' ),
    'items_list' => __( 'Список примеров', 'text_domain' ),
    'items_list_navigation' => __( 'Постраничная навигация', 'text_domain' ),
    'filter_items_list' => __( 'Фильтр', 'text_domain' ),
    ),
    'description' => '',
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-welcome-view-site',
    'map_meta_cap' => null,
    'hierarchical' => false,

    // Управление полями для редактирования объекта типа записи.
    // По умолчанию: значения 'title' и 'editor'.
    'supports' => array(
        'title', // Заголовок объекта типа записи.
        'editor', // Редактор контента
        'thumbnail', // Миниатюра.
        'revisions', // Сохраняет версии.
    ),

    'register_meta_box_cb' => null,
    'taxonomies' => array('car_brand_tax'),
    'has_archive' => false,
    'rewrite' => array(
        'slug' => 'auto-portfolio',
        'with_front' => false,
        'feeds' => false,
        'pages' => true,
    ),
   
    // Перезаписывает конечное значение. По умолчанию: EP_PERMALINK.
    'permalink_epmask' => EP_PERMALINK,
    // Задается значение запроса для данного типа записи.
    //  По умолчанию: true - задается значение $post_type.
    'query_var' => true,
    // Возможность данного типа записи быть экспортированным. По умолчанию: true.
    'can_export' => true,
    // Удалять ли записи данного типа при удалении их автора. По умолчанию: null.
    'delete_with_user' => null,
    // Представлять ли этот тип записи в REST API. По умолчанию: false.
    'show_in_rest' => false,
    // Базовый ярлык данного типа записи когда доступно использование REST API.
    //  По умолчанию: значение $post_type.
    'rest_base' => $post_type,
    // Является ли этот тип записи собственным или встроенным.
    //  Рекомендация: не использовать этот аргумент при регистрации собственного типа сообщения. По умолчанию: false.
    '_builtin' => false,
);
register_post_type( 'auto-portfolio', $args );
}

add_action( 'init', 'create_taxonomy_car_brand' );
function create_taxonomy_car_brand(){

	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'car_brand_tax', [ 'auto-portfolio' ], [ 
		'label'                 => 'car-brand', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Марки',
			'singular_name'     => 'Марка',
			'search_items'      => 'Найти марку',
			'all_items'         => 'Все марки',
			'view_item '        => 'Посмотреть марку',
			'parent_item'       => 'Родительская марка',
			'parent_item_colon' => 'Родительская марка:',
			'edit_item'         => 'Изменить марку',
			'update_item'       => 'Обновить марку',
			'add_new_item'      => 'Добавить новую марку',
			'new_item_name'     => 'Новая марка',
			'menu_name'         => 'Марки',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}

function taxonomy_link( $link, $term, $taxonomy ) {
    if ( $taxonomy !== 'auto-portfolio' )
        return $link;
    return str_replace( 'auto-portfolio/auto-portfolio/', '', $link );
}
add_filter( 'term_link', 'taxonomy_link', 10, 3 );

// Редирект:
function taxonomy_rewrite_rule() {
    add_rewrite_rule('allauto-portfolio/?$', 'index.php?auto-portfolio=allauto-portfolio', 'top');
}
add_action('init', 'taxonomy_rewrite_rule');

function add_car_brand_tax_column_content($content,$column_name,$term_id){
    $term= get_term($term_id, 'car_brand_tax');
    switch ($column_name) {
        case 'foo':
            //do your stuff here with $term or $term_id
            $content = 'test';
            break;
        default:
            break;
    }
    return $content;
}
add_filter('manage_car_brand_tax_custom_column', 'add_car_brand_tax_column_content',10,3);

add_filter("manage_edit-car_brand_tax_columns", 'theme_columns'); 
 
function theme_columns($theme_columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'name' => __('Name'),
        'header_icon' => '',
		'shortcode' => __('Shortcode'),
        'slug' => __('Slug'),
        'posts' => __('Posts')
        );
    return $new_columns;
}?>