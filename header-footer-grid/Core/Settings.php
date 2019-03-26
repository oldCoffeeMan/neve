<?php
/**
 * Settings class for Header Footer Grid.
 * Holds all settings for this module.
 *
 * Name:    Header Footer Grid
 * Author:  Bogdan Preda <bogdan.preda@themeisle.com>
 *
 * @version 1.0.0
 * @package HFG
 */

namespace HFG\Core;

/**
 * Class Settings
 *
 * @package HFG\Core
 */
class Settings {

	/**
	 * Holds an instance of this class.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var Settings $_instance
	 */
	private static $_instance = null;

	/**
	 * Holds the file path to the module directory.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var string $path
	 */
	public $path;

	/**
	 * Holds the url to the module directory.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var string $url
	 */
	public $url;

	/**
	 * Holds the theme support settings.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var array $theme_support
	 */
	private $theme_support = array();

	/**
	 * Returns the instance of the class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return Settings
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance       = new self();
			self::$_instance->path = get_template_directory() . '/header-footer-grid';
			self::$_instance->url  = get_template_directory_uri() . '/header-footer-grid';
			self::$_instance->set();
		}

		return self::$_instance;
	}

	/**
	 * Set defaults
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function set() {
		$theme_support_defaults = array(
			'builders' => array(
				'HFG\Core\Builder\Header' => array(
					'HFG\Core\Components\Logo',
					'HFG\Core\Components\MenuIcon',
					'HFG\Core\Components\Button',
					'HFG\Core\Components\CustomHtml',
				),
				'HFG\Core\Builder\Footer' => array(
					'HFG\Core\Components\FooterWidgetOne',
					'HFG\Core\Components\FooterWidgetTwo',
					'HFG\Core\Components\FooterWidgetThree',
					'HFG\Core\Components\FooterWidgetFour',
					'HFG\Core\Components\FooterWidgetFive',
					'HFG\Core\Components\FooterWidgetSix',
					'HFG\Core\Components\Copyright',
				),
			),
		);
		$theme_support          = get_theme_support( 'hfg_support' );

		$settings            = wp_parse_args( $theme_support, $theme_support_defaults );
		$this->theme_support = $settings;
	}

	/**
	 * Getter for theme support.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function get_theme_support() {
		return $this->theme_support;
	}

	/**
	 * Header defaults for Neve
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function get_header_defaults_neve() {
		$defaults = [
			'desktop' => [
				'top'    => [],
				'main'   => [],
				'bottom' => [],
			],
			'mobile'  => [
				'top'     => [],
				'main'    => [],
				'bottom'  => [],
				'sidebar' => [],
			],
		];

		if ( (bool) get_theme_mod( 'neve_top_bar_enable', false ) ) {
			$alignament = get_theme_mod( 'neve_top_bar_layout', 'content-menu' );
			if ( $alignament === 'content-menu' ) {
				$defaults['desktop']['top']['custom_html']    = [
					'id'    => 'custom_html',
					'width' => 6,
					'x'     => 0,
				];
				$defaults['desktop']['top']['secondary-menu'] = [
					'id'    => 'secondary-menu',
					'width' => 6,
					'x'     => 6,
				];
			}
			if ( $alignament === 'menu-content' ) {
				$defaults['desktop']['top']['secondary-menu'] = [
					'id'    => 'secondary-menu',
					'width' => 6,
					'x'     => 0,
				];
				$defaults['desktop']['top']['custom_html']    = [
					'id'    => 'custom_html',
					'width' => 6,
					'x'     => 6,
				];
			}
		}

		$layout            = get_theme_mod( 'neve_navigation_layout', 'left' );
		$last_item_default = 'search';
		if ( class_exists( 'WooCommerce' ) ) {
			$last_item_default = 'search-cart';
		}

		$last_item = get_theme_mod( 'neve_last_menu_item', $last_item_default );
		$extra     = [];
		if ( $last_item === 'none' ) {
			$menu_width = 8;
		}

		if ( $last_item === 'search' ) {
			$menu_width = 7;
			$extra[]    = [
				'id'    => 'header_search_responsive',
				'width' => 1,
				'x'     => 0,
			];
		}

		if ( $last_item === 'cart' ) {
			$menu_width = 7;
			$extra[]    = [
				'id'    => 'header_cart_icon',
				'width' => 1,
				'x'     => 0,
			];
		}

		if ( $last_item === 'search-cart' ) {
			$menu_width = 6;
			$extra[]    = [
				'id'    => 'header_search_responsive',
				'width' => 1,
				'x'     => 0,
			];
			$extra[]    = [
				'id'    => 'header_cart_icon',
				'width' => 1,
				'x'     => 0,
			];
		}

		if ( $last_item === 'cart-search' ) {
			$menu_width = 6;
			$extra[]    = [
				'id'    => 'header_cart_icon',
				'width' => 1,
				'x'     => 0,
			];
			$extra[]    = [
				'id'    => 'header_search_responsive',
				'width' => 1,
				'x'     => 0,
			];
		}

		if ( $layout === 'left' ) {
			$defaults['desktop']['main']['logo']         = [
				'id'       => 'logo',
				'width'    => 4,
				'x'        => 0,
				'settings' => [
					'align' => 'center',
				],
			];
			$defaults['desktop']['main']['primary-menu'] = [
				'id'    => 'primary-menu',
				'width' => $menu_width,
				'x'     => 4,
			];
			foreach ( $extra as $extra_item ) {
				$extra_item['x']                                    = 4 + $menu_width + 1;
				$defaults['desktop']['bottom'][ $extra_item['id'] ] = $extra_item;
			}
		}

		if ( $layout === 'center' ) {
			$defaults['desktop']['main']['logo']           = [
				'id'    => 'logo',
				'width' => 6,
				'x'     => 3,
			];
			$defaults['desktop']['bottom']['primary-menu'] = [
				'id'    => 'primary-menu',
				'width' => $menu_width,
				'x'     => 3,
			];

			foreach ( $extra as $extra_item ) {
				$extra_item['x']                                    = 3 + $menu_width + 1;
				$defaults['desktop']['bottom'][ $extra_item['id'] ] = $extra_item;
			}
		}

		if ( $layout === 'right' ) {
			$defaults['desktop']['main']['primary-menu'] = [
				'id'    => 'primary-menu',
				'width' => $menu_width,
				'x'     => 0,
			];
			foreach ( $extra as $extra_item ) {
				$extra_item['x']                                  = $menu_width + 1;
				$defaults['desktop']['main'][ $extra_item['id'] ] = $extra_item;
			}
			$defaults['desktop']['main']['logo'] = [
				'id'    => 'logo',
				'width' => 4,
				'x'     => 8,
			];
		}

		return json_encode( $defaults );
	}

	/**
	 * Footer defaults for Neve
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function get_footer_defaults_neve() {
		return json_encode(
			[
				'desktop' => [
					'top'    => [],
					'bottom' => [
						[
							'id'    => 'footer_copyright',
							'width' => 1,
							'x'     => 6,
						],
					],
				],
			]
		);
	}

	/**
	 * Utility method to return media url.
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param  mixed      $value The media reference.
	 * @param mixed|null $size Optional. The size desired.
	 *
	 * @return array|bool|false|string
	 */
	public function get_media( $value, $size = 'full' ) {

		if ( empty( $value ) ) {
			return false;
		}

		$media = false;
		if ( is_numeric( $value ) ) {
			$media = $this->media_from_id( $value, $size );
		} elseif ( is_string( $value ) ) {
			$media = $this->media_from_url( $value, $size );
		} elseif ( is_array( $value ) ) {
			$media = $this->media_from_array( $value, $size );
		}

		return $media;
	}

	/**
	 * Retrieve media from post id.
	 *
	 * @since   1.0.0
	 * @access  private
	 *
	 * @param int    $id Post ID.
	 * @param string $size Media size.
	 *
	 * @return bool
	 */
	private function media_from_id( $id, $size = 'full' ) {
		$image_attributes = wp_get_attachment_image_src( $id, $size );
		if ( ! $image_attributes ) {
			return false;
		}

		return $image_attributes[0];
	}

	/**
	 * Retrieve media from attachment url.
	 *
	 * @since   1.0.0
	 * @access  private
	 *
	 * @param string $url The attachment url.
	 * @param string $size The media size.
	 *
	 * @return bool
	 */
	private function media_from_url( $url, $size = 'full' ) {
		$img_id = attachment_url_to_postid( $url );
		if ( $img_id ) {
			$image_attributes = wp_get_attachment_image_src( $img_id, $size );
			if ( ! $image_attributes ) {
				return false;
			}

			return $image_attributes[0];
		}

		return $url;
	}

	/**
	 * Retrieve media from an array.
	 *
	 * @param array  $array Array for media.
	 * @param string $size The media size.
	 *
	 * @return bool|false|string
	 */
	private function media_from_array( $array = array(), $size = 'full' ) {
		$value = wp_parse_args(
			$array,
			array(
				'id'   => '',
				'url'  => '',
				'mime' => '',
			)
		);

		if ( empty( $array['id'] ) && empty( $array['url'] ) ) {
			return false;
		}

		$media_url = '';

		if ( strpos( $array['mime'], 'image/' ) !== false ) {
			$image_attributes = wp_get_attachment_image_src( $array['id'], $size );
			if ( $image_attributes ) {
				$media_url = $image_attributes[0];
			}
		} else {
			$media_url = wp_get_attachment_url( $array['id'] );
		}

		if ( ! $media_url ) {
			$media_url = $value['url'];
			if ( $media_url ) {
				$img_id = attachment_url_to_postid( $media_url );
				if ( $img_id ) {
					return wp_get_attachment_url( $img_id );
				}
			}
		}

		return $media_url;
	}

}
