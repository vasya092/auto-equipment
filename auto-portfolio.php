<?php
/**
 * Plugin Name: Auto-porfolio
 * Plugin URI:  https://websourcepro.ru
 * Description: Плагин, позволяющий создавать категории отдельно для каждой марки.
 * Author:      WebSourcePro
 * Author URI:  https://websourcepro.ru
 * Version:     1.0
 *
 * Auto-porfolio is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Auto-porfolio is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Auto-porfolio. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    Auto-porfolio
 * @author     webraz12@gmail.com
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, Auto-porfolio LLC
 */

?>
<?php
function special_plugin_styles() {
	wp_register_style('styles', plugins_url('/css/styles.css', __FILE__));
	wp_enqueue_style('styles');
	}
add_action( 'wp_enqueue_scripts', 'special_plugin_styles' );

require_once __DIR__ . '/taxonomy/taxonomy_init.php';
require_once __DIR__ . '/taxonomy/taxonomy_load_file.php';

add_filter('template_include', 'lessons_template');

function lessons_template( $template ) {
  if ( is_post_type_archive('auto-portfolio') ) {
      return plugin_dir_path(__FILE__) . 'archive-lesson.php';
  }
  return $template;
}

add_shortcode('show_all_car_brands', 'ShowAllCarBrands');

function ShowAllCarBrands()
{
	$brands = get_terms([
		'taxonomy' => 'car_brand_tax',
		'hide_empty' => false,
	]);?>
	<div class="port-wrapper">
	<?
	foreach($brands as $brand)
	{	
		$img_id = get_term_meta( $brand->term_id, '_thumbnail_id', 1 );
		$img_url = wp_get_attachment_image_url( $img_id, 'full' );
		$term_link = get_term_link($brand->term_id, 'car_brand_tax');
		?>
		<a href="<?php echo $term_link; ?>"><div class="port-item"><?
		echo '<img src="'. $img_url .'" alt="" />';
		echo '<p class="port-item-title">'.$brand->name.'</p>';?>
		</div></a>
		<?
	}
	?>
	</div>
	<?
} ?>