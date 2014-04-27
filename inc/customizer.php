<?php
/**
 * Sans Sidebar Underscores Theme Customizer
 *
 * @package Sans Sidebar Underscores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ssu_customize_register( $wp_customize ) {

	/** ===============
	* Extends CONTROLS class to add textarea
	*/
	class ssu_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>

			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>

		<?php
		}
	}	

	/** ===============
	* Add NEW customizer SECTIONS
	*/
	$add_sections = array(
		'layout'			=> array(
			'id'			=> 'ssu_layout_section',
			'title'			=> __( 'Layout Options', 'ssu' ),
			'description'	=> __( 'Adjust the layout of your website. All options have a default value that can be left as-is but you are free to customize.', 'ssu' ),
			'priority'		=> 30
		),
		'content'			=> array(
			'id'			=> 'ssu_content_section',
			'title'			=> __( 'Content Options', 'ssu' ),
			'description'	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'ssu' ),
			'priority'		=> 35
		),
	);
	// Build the sections based on the $add_sections array
	foreach ( $add_sections as $section ) {
		$wp_customize->add_section( $section[ 'id' ], array(
			'title'			=> $section[ 'title' ],
			'description'	=> $section[ 'description' ],
			'priority'		=> $section[ 'priority' ],
		) );
	}

	/** ===============
	* Add NEW customizer SETTINGS
	*/
	$add_settings = array(
		'body layout'		=> array(
			'id'			=> 'ssu_body_layout',
			'default'		=> 1
		),
		'site copyright'	=> array(
			'id'			=> 'ssu_credits_copyright',
			'default'		=> null
		),
		'post footer content'	=> array(
			'id'				=> 'ssu_post_footer_content',
			'default'			=> 'Main Post Footer Content'
		),
	);
	// Build the settings based on the $add_settings
	foreach ( $add_settings as $setting ) {
		$wp_customize->add_setting( $setting[ 'id' ], array( 
			'default'	=> $setting[ 'default' ] 
		) );
	}

	/** ===============
	* Add NEW customizer CONTROLS ** by control type **
	*/        

	// Text input control types
	$add_text_controls = array(
		'ssu_credits_copyright'		=> array(
			'id'					=> 'ssu_credits_copyright',
			'label'					=> __( 'Footer Credits & Copyright', 'ssu' ),
			'section'				=> 'ssu_content_section',
			'settings'				=> 'ssu_credits_copyright',
			'priority'				=> 60,
		),
	);
	// Build the text input controls based on the $add_text_controls
	foreach ( $add_text_controls as $control ) {
		$wp_customize->add_control( $control[ 'id' ], array(
			'label'		=> $control[ 'label' ],
			'section'	=> $control[ 'section' ],
			'settings'	=> $control[ 'settings' ],
			'priority'	=> $control[ 'priority' ]
		) );
	}

	// Textarea input control types
	$add_textarea_controls = array(
		'ssu_post_footer_content'	=> array(
			'id'					=> 'ssu_post_footer_content',
			'label'					=> __( 'Post Footer Content', 'ssu' ),
			'section'				=> 'ssu_content_section',
			'settings'				=> 'ssu_post_footer_content',
			'priority'				=> 30,
		),
	);
	// Build the textarea input controls based on the $add_textarea_controls
	foreach ( $add_textarea_controls as $control ) {
		$wp_customize->add_control( new ssu_customize_textarea_control( $wp_customize, $control[ 'id' ], array(
			'label'		=> $control[ 'label' ],
			'section'	=> $control[ 'section' ],
			'settings'	=> $control[ 'settings' ],
			'priority'	=> $control[ 'priority' ]
		) ) );
	}

	// Checkbox input control types        
	$add_checkbox_controls = array(
		'ssu_body_layout'	=> array(
			'id'			=> 'ssu_body_layout',
			'label'			=> __( 'Hide Sidebar', 'ssu' ),
			'section'		=> 'ssu_layout_section',
			'priority'		=> 10
		),
	);
	// Build the checkbox input controls based on the $add_checkbox_controls
	foreach ( $add_checkbox_controls as $control ) {
		$wp_customize->add_control( $control[ 'id' ], array(
			'label'		=> $control[ 'label' ],
			'section'	=> $control[ 'section' ],
			'priority'	=> $control[ 'priority' ],
			'type'		=> 'checkbox',
		) );
	}

	/** ===============
	* Add to, take away from, and edit EXISTING WordPress sections
	*/

	// logo uploader setting
	$wp_customize->add_setting( 'ssu_logo', array( 'default' => null ) );

	// logo uploader control
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ssu_logo', array(
		'label'		=> __( 'Custom Site Logo', 'ssu' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'ssu_logo',
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	/**
     * uncomment to change default section titles
     */
    // $wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'ssu' );
    // $wp_customize->get_section( 'colors' )->title = __( 'Color Settings', 'ssu' );
    // $wp_customize->get_section( 'background_image' )->title = __( 'Background', 'ssu' );
    // $wp_customize->get_section( 'nav' )->title = __( 'Navigation Menu', 'ssu' );
    
    /**
     * uncomment to change default section order
     */
    // $wp_customize->get_section( 'title_tagline' )->priority = 10;
    // $wp_customize->get_section( 'colors' )->priority = 20;
    // $wp_customize->get_section( 'background_image' )->priority = 40;
    // $wp_customize->get_section( 'nav' )->priority = 50;
    // $wp_customize->get_section( 'static_front_page' )->priority = 60;

    /**
     * uncomment to remove default sections
     */
    // $wp_customize_manager->remove_section( 'title_tagline' );
    // $wp_customize_manager->remove_section( 'colors' );
    // $wp_customize_manager->remove_section( 'nav' );

} 

add_action( 'customize_register', 'ssu_customize_register' );

/**
* Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function ssu_customize_preview_js() {
	wp_enqueue_script( 'ssu_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'ssu_customize_preview_js' );
