<?php
/**
 * BE WPForms Secret Key
 *
 * @package    BE_WPForms_Secret_Key
 * @since      1.0.0
 * @copyright  Copyright (c) 2018, Bill Erickson
 * @license    GPL-2.0+
 */

class BE_WPForms_Secret_Key {

    /**
     * Primary Class Constructor
     *
     */
    public function __construct() {

        add_filter( 'wpforms_builder_settings_sections', array( $this, 'settings_section' ), 20, 2 );
        add_filter( 'wpforms_form_settings_panel_content', array( $this, 'settings_section_content' ), 20 );
        add_filter( 'wpforms_process_honeypot', array( $this, 'secret_key_in_honeypot' ), 10, 4 );
		add_filter( 'wpforms_wp_footer_end', array( $this, 'secret_key_in_form' ) );

    }

    /**
     * Add Settings Section
     *
     */
    function settings_section( $sections, $form_data ) {
        $sections['be_secret_key'] = __( 'Secret Key', 'be-wpforms-secret-key' );
        return $sections;
    }


    /**
     * ConvertKit Settings Content
     *
     */
    function settings_section_content( $instance ) {
        echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-be_secret_key">';
        echo '<div class="wpforms-panel-content-section-title">' . __( 'Secret Key', 'be-wpforms-secret-key' ) . '</div>';

        wpforms_panel_field(
            'text',
            'settings',
            'be_secret_key',
            $instance->form_data,
            __( 'Secret Key', 'be-wpforms-secret-key' )
        );

        echo '</div>';
    }

	/**
	 * Use Secret Key in Honeypot
	 *
	 */
	function secret_key_in_honeypot( $honeypot, $fields, $entry, $form_data ) {

		if( empty( $form_data['settings']['be_secret_key'] ) )
			return $honeypot;

	    foreach( $form_data['fields'] as $field ) {
	        if ( ! empty( $field['css'] ) && 'secret-key' === $field['css'] ) {

	            if ( empty( $fields[ $field['id'] ]['value'] ) || $form_data['settings']['be_secret_key'] !== $fields[ $field['id'] ]['value'] ) {
	                return true;
	            }
	        }
	    }

	    return $honeypot;
	}

    /**
	 * Secret Key in Form
	 *
	 */
	function secret_key_in_form( $forms ) {

		if( empty( $forms ) )
			return;

		$secret_keys = array();
		foreach( $forms as $form_id => $form ) {
			if( !empty( $form['settings']['be_secret_key'] ) ) {
				$secret_keys[ $form_id ] = $form['settings']['be_secret_key'];
			}
		}

		if( empty( $secret_keys ) )
			return;

   ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
			<?php
			foreach( $secret_keys as $form_id => $value ) {
				echo '$(\'#wpforms-' . $form_id . ' .wpforms-field.secret-key\').val(\'' . $value . '\');';
			}
			?>
        });
    </script>
    <?php

	}
}
new BE_WPForms_Secret_Key;
