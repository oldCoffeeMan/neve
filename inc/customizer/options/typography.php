<?php
/**
 * Customizer typography controls.
 *
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      20/08/2018
 *
 * @package Neve\Customizer\Options
 */

namespace Neve\Customizer\Options;

use Neve\Customizer\Base_Customizer;
use Neve\Customizer\Types\Control;
use Neve\Customizer\Types\Section;

/**
 * Class Typography
 *
 * @package Neve\Customizer\Options
 */
class Typography extends Base_Customizer {
	/**
	 * Add controls
	 */
	public function add_controls() {
		$this->sections_typography();
		$this->controls_typography_general();
		$this->controls_typography_headings();
	}

	/**
	 * Add the customizer section.
	 */
	private function sections_typography() {
		$typography_sections = array(
			'neve_typography_general'  => array(
				'title'    => __( 'General', 'neve' ),
				'priority' => 25,
			),
			'neve_typography_headings' => array(
				'title'    => __( 'Headings', 'neve' ),
				'priority' => 35,
			),
		);

		foreach ( $typography_sections as $section_id => $section_data ) {
			$this->add_section(
				new Section(
					$section_id,
					array(
						'title'    => $section_data['title'],
						'panel'    => 'neve_typography',
						'priority' => $section_data['priority'],
					)
				)
			);
		}
	}

	/**
	 * Add general typography controls
	 */
	private function controls_typography_general() {
		/**
		 * Body font family
		 */
		$this->add_control(
			new Control(
				'neve_body_font_family',
				[
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_text_field',
				],
				[
					'label'    => esc_html__( 'Font Family', 'neve' ),
					'section'  => 'neve_typography_general',
					'priority' => 10,
					'type'     => 'neve_font_family_control'
				]
			)
		);

		$this->add_control( new Control(
				'neve_typeface_general',
				[
					'transport' => 'postMessage',
					'default'   => $this->get_body_typography_defaults()
				],
				[
					'priority' => 11,
					'label'    => __( 'Body', 'neve' ),
					'section'  => 'neve_typography_general',
					'type'     => 'neve_typeface_control',
				]
			)
		);

//		$this->add_control(
//			new Control(
//				'neve_body_font_family',
//				array(
//					'transport'         => $this->selective_refresh,
//					'sanitize_callback' => 'sanitize_text_field',
//					'default'           => 'default',
//				),
//				array(
//					'label'    => esc_html__( 'Font Family', 'neve' ),
//					'section'  => 'neve_typography_general',
//					'priority' => 12,
//				),
//				'Neve\Customizer\Controls\Font_Selector'
//			)
//		);

		/**
		 * Font Weight
		 */
		$this->add_control(
			new Control(
				'neve_body_font_weight',
				array(
					'sanitize_callback' => 'neve_sanitize_font_weight',
					'transport'         => $this->selective_refresh,
					'default'           => '400',
				),
				array(
					'label'    => esc_html__( 'Font Weight', 'neve' ),
					'section'  => 'neve_typography_general',
					'type'     => 'select',
					'choices'  => array(
						100 => '100',
						200 => '200',
						300 => '300',
						400 => '400',
						500 => '500',
						600 => '600',
						700 => '700',
						800 => '800',
						900 => '900',
					),
					'priority' => 15,
				)
			)
		);

		/**
		 * Text Transform
		 */
		$this->add_control(
			new Control(
				'neve_body_text_transform',
				array(
					'sanitize_callback' => 'neve_sanitize_text_transform',
					'transport'         => $this->selective_refresh,
					'default'           => 'none',
				),
				array(
					'label'    => esc_html__( 'Text Transform', 'neve' ),
					'section'  => 'neve_typography_general',
					'type'     => 'select',
					'choices'  => array(
						'none'       => __( 'None', 'neve' ),
						'capitalize' => __( 'Capitalize', 'neve' ),
						'uppercase'  => __( 'Uppercase', 'neve' ),
						'lowercase'  => __( 'Lowercase', 'neve' ),
					),
					'priority' => 20,
				)
			)
		);

		/**
		 * Body font size
		 */
		$this->add_control(
			new Control(
				'neve_body_font_size',
				array(
					'sanitize_callback' => 'neve_sanitize_range_value',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'      => esc_html__( 'Font Size', 'neve' ),
					'section'    => 'neve_typography_general',
					'units'      => array(
						'px',
					),
					'input_attr' => array(
						'mobile'  => array(
							'min'          => 10,
							'default'      => 15,
							'default_unit' => 'px',
						),
						'tablet'  => array(
							'min'          => 10,
							'default'      => 16,
							'default_unit' => 'px',
						),
						'desktop' => array(
							'min'          => 10,
							'default'      => 16,
							'default_unit' => 'px',
						),
					),
					'priority'   => 25,
					'responsive' => true,
				),
				'Neve\Customizer\Controls\Responsive_Number'
			)
		);

		/**
		 * Body line height
		 */
		$this->add_control(
			new Control(
				'neve_body_line_height',
				array(
					'sanitize_callback' => 'neve_sanitize_range_value',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'       => esc_html__( 'Line Height', 'neve' ),
					'section'     => 'neve_typography_general',
					'step'        => 0.1,
					'input_attr'  => array(
						'mobile'  => array(
							'min'     => 0.5,
							'max'     => 4,
							'default' => 1.6,
						),
						'tablet'  => array(
							'min'     => 0.5,
							'max'     => 4,
							'default' => 1.6,
						),
						'desktop' => array(
							'min'     => 0.5,
							'max'     => 4,
							'default' => 1.6,
						),
					),
					'priority'    => 35,
					'media_query' => true,
				),
				'Neve\Customizer\Controls\Range'
			)
		);

		/**
		 * Letter Spacing
		 */
		$this->add_control(
			new Control(
				'neve_body_letter_spacing',
				array(
					'sanitize_callback' => 'neve_sanitize_range_value',
					'transport'         => $this->selective_refresh,
					'default'           => '',
				),
				array(
					'label'      => esc_html__( 'Letter Spacing', 'neve' ) . ' (px)',
					'section'    => 'neve_typography_general',
					'step'       => 0.1,
					'input_attr' => array(
						'min'     => - 5,
						'max'     => 20,
						'default' => 0,
					),
					'priority'   => 35,
				),
				'Neve\Customizer\Controls\Range'
			)
		);

		/**
		 * Font subsets
		 */
		$this->add_control(
			new Control(
				'neve_font_subsets',
				array(
					'sanitize_callback' => array( $this, 'sanitize_font_subsets' ),
					'default'           => array( 'latin' ),
				),
				array(
					'section'  => 'neve_typography_general',
					'label'    => esc_html__( 'Font Subsets', 'neve' ),
					'choices'  => array(
						'latin'        => 'latin',
						'latin-ext'    => 'latin-ext',
						'cyrillic'     => 'cyrillic',
						'cyrillic-ext' => 'cyrillic-ext',
						'greek'        => 'greek',
						'greek-ext'    => 'greek-ext',
						'vietnamese'   => 'vietnamese',
					),
					'priority' => 40,
				),
				'Neve\Customizer\Controls\Multi_Select'
			)
		);
	}

	/**
	 * Add controls for typography headings.
	 */
	private function controls_typography_headings() {
		/**
		 * Headings font family
		 */
		$this->add_control(
			new Control(
				'neve_headings_font_family',
				array(
					'transport'         => $this->selective_refresh,
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => 'default',
				),
				array(
					'label'    => esc_html__( 'Font Family', 'neve' ),
					'section'  => 'neve_typography_headings',
					'priority' => 10,
				),
				'Neve\Customizer\Controls\Font_Selector'
			)
		);

		$controls = $this->get_headings_controls();

		$line_height_default = get_theme_mod( 'neve_headings_line_height' );
		foreach ( $controls as $control_id => $control ) {
			/**
			 * Font size
			 */
			$this->add_control(
				new Control(
					$control_id . '_font_size',
					array(
						'sanitize_callback' => 'neve_sanitize_range_value',
						'transport'         => $this->selective_refresh,
					),
					array(
						'label'      => $control['heading'] . ' ' . esc_html__( 'Font Size', 'neve' ),
						'section'    => 'neve_typography_headings',
						'step'       => 1,
						'units'      => array(
							'em',
							'px',
						),
						'input_attr' => array(
							'mobile'  => array(
								'min'          => 1,
								'default'      => $control['default_tablet_size'],
								'default_unit' => 'em',
							),
							'tablet'  => array(
								'min'          => 1,
								'default'      => $control['default_tablet_size'],
								'default_unit' => 'em',
							),
							'desktop' => array(
								'min'          => 1,
								'default'      => $control['default_size'],
								'default_unit' => 'em',
							),
						),
						'priority'   => $control['priority'],
						'responsive' => true,
					),
					'Neve\Customizer\Controls\Responsive_Number'
				)
			);

			/**
			 * Line height
			 */
			$this->add_control(
				new Control(
					$control_id . '_line_height',
					array(
						'sanitize_callback' => 'neve_sanitize_range_value',
						'transport'         => $this->selective_refresh,
						'default'           => $line_height_default,
					),
					array(
						'label'       => $control['heading'] . ' ' . esc_html__( 'Line Height', 'neve' ),
						'section'     => 'neve_typography_headings',
						'step'        => 0.1,
						'input_attr'  => array(
							'mobile'  => array(
								'min'     => 0.5,
								'max'     => 4,
								'default' => 1.6,
							),
							'desktop' => array(
								'min'     => 0.5,
								'max'     => 4,
								'default' => 1.6,
							),
							'tablet'  => array(
								'min'     => 0.5,
								'max'     => 4,
								'default' => 1.6,
							),
						),
						'priority'    => $control['priority'] + 1,
						'media_query' => true,
					),
					'Neve\Customizer\Controls\Range'
				)
			);
		}

		/**
		 * Letter Spacing
		 */
		$this->add_control(
			new Control(
				'neve_headings_letter_spacing',
				array(
					'sanitize_callback' => 'neve_sanitize_range_value',
					'transport'         => $this->selective_refresh,
					'default'           => '',
				),
				array(
					'label'      => esc_html__( 'Letter Spacing', 'neve' ) . ' (px)',
					'section'    => 'neve_typography_headings',
					'step'       => 0.1,
					'input_attr' => array(
						'min'     => - 5,
						'max'     => 20,
						'default' => 0,
					),
					'priority'   => 80,
				),
				'Neve\Customizer\Controls\Range'
			)
		);

		/**
		 * Font Weight
		 */
		$this->add_control(
			new Control(
				'neve_headings_font_weight',
				array(
					'sanitize_callback' => 'neve_sanitize_font_weight',
					'transport'         => $this->selective_refresh,
					'default'           => '600',
				),
				array(
					'label'    => esc_html__( 'Font Weight', 'neve' ),
					'section'  => 'neve_typography_headings',
					'type'     => 'select',
					'choices'  => array(
						100 => '100',
						200 => '200',
						300 => '300',
						400 => '400',
						500 => '500',
						600 => '600',
						700 => '700',
						800 => '800',
						900 => '900',
					),
					'priority' => 15,
				)
			)
		);

		/**
		 * Text Transform
		 */
		$this->add_control(
			new Control(
				'neve_headings_text_transform',
				array(
					'sanitize_callback' => 'neve_sanitize_text_transform',
					'transport'         => $this->selective_refresh,
					'default'           => 'none',
				),
				array(
					'label'    => esc_html__( 'Text Transform', 'neve' ),
					'section'  => 'neve_typography_headings',
					'type'     => 'select',
					'choices'  => array(
						'none'       => __( 'None', 'neve' ),
						'capitalize' => __( 'Capitalize', 'neve' ),
						'uppercase'  => __( 'Uppercase', 'neve' ),
						'lowercase'  => __( 'Lowercase', 'neve' ),
					),
					'priority' => 20,
				)
			)
		);
	}

	/**
	 * Get the controls for the headings.
	 *
	 * @return array
	 */
	private function get_headings_controls() {
		return array(
			'neve_h1' => array(
				'priority'            => 25,
				'default_size'        => '2',
				'default_tablet_size' => '1.5',
				'heading'             => 'H1',
			),
			'neve_h2' => array(
				'priority'            => 30,
				'default_size'        => '1.75',
				'default_tablet_size' => '1.3',
				'heading'             => 'H2',
			),
			'neve_h3' => array(
				'priority'            => 35,
				'default_size'        => '1.5',
				'default_tablet_size' => '1.1',
				'heading'             => 'H3',
			),
			'neve_h4' => array(
				'priority'            => 40,
				'default_size'        => '1.25',
				'default_tablet_size' => '1',
				'heading'             => 'H4',
			),
			'neve_h5' => array(
				'priority'            => 45,
				'default_size'        => '1',
				'default_tablet_size' => '0.75',
				'heading'             => 'H5',
			),
			'neve_h6' => array(
				'priority'            => 50,
				'default_size'        => '1',
				'default_tablet_size' => '0.75',
				'heading'             => 'H6',
			),
		);
	}

	/**
	 * Sanitize the font subsets
	 */
	public function sanitize_font_subsets( $value ) {
		if ( ! is_array( $value ) ) {
			return array( 'latin' );
		}

		$allowed_values = array(
			'latin',
			'latin-ext',
			'cyrillic',
			'cyrillic-ext',
			'greek',
			'greek-ext',
			'vietnamese',
		);
		foreach ( $value as $index => $font_subset ) {
			if ( ! in_array( $font_subset, $allowed_values, true ) ) {
				unset( $value[ $index ] );
			}
		}

		return $value;
	}

	private function get_body_typography_defaults() {
		$default = array(
			'fontFamily'    => 'default',
			'fontSize'      => array(
				'suffix'  => array( 'mobile' => 'px', 'tablet' => 'px', 'desktop' => 'px' ),
				'mobile'  => 15,
				'tablet'  => 16,
				'desktop' => 16,
			),
			'lineHeight'    => array(
				'mobile'  => 1.6,
				'tablet'  => 1.6,
				'desktop' => 1.6,
			),
			'letterSpacing' => array(
				'mobile'  => 0,
				'tablet'  => 0,
				'desktop' => 0,
			),
			'fontWeight'    => '400',
			'textTransform' => 'none'
		);

		$font_size      = get_theme_mod( 'neve_body_font_size' );
		$line_height    = get_theme_mod( 'neve_body_line_height' );
		$body_font      = get_theme_mod( 'neve_body_font_family' );
		$spacing        = get_theme_mod( 'neve_body_letter_spacing' );
		$text_transform = get_theme_mod( 'neve_body_text_transform' );
		$font_weight    = get_theme_mod( 'neve_body_font_weight' );

		if ( ! empty( $font_size ) ) {
			$default['fontSize'] = json_decode( $font_size, true );
		}
		if ( ! empty( $line_height ) ) {
			$default['lineHeight'] = json_decode( $line_height, true );
		}
		if ( ! empty( $body_font ) ) {
			$default['fontFamily'] = $body_font;
		}
		if ( ! empty( $spacing ) ) {
			$default['letterSpacing'] = array(
				'mobile'  => $spacing,
				'tablet'  => $spacing,
				'desktop' => $spacing,
			);
		}
		if ( ! empty( $text_transform ) ) {
			$default['textTransform'] = $text_transform;
		}
		if ( ! empty( $font_weight ) ) {
			$default['fontWeight'] = $font_weight;
		}

		return $default;
	}
}

