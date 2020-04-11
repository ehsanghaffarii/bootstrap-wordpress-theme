<?php


/***
 * Ein Post type Meta-Boxs
 */


 /******************** Article ***********************/

 class Article_Meta_Box {
	private $screens = array(
		'article',
	);
	private $fields = array(
		array(
			'id' => 'articletype',
			'label' => 'Article Type',
			'type' => 'select',
			'options' => array(
                'Research',
                'Reviews',
                'Newsworthy',
                'Interviews',
                'How-To - Tutorial',
                'Controversial',
                'Commentary',
			),
		),
		array(
			'id' => 'publication-date',
			'label' => 'Publication Date',
			'type' => 'date',
		),
		array(
			'id' => 'stars',
			'label' => 'Stars',
            'type' => 'select',
            'options' => array(
                1,
                2,
                3,
                4,
                5,
            )
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'article-info',
				__( 'article info', 'rational-metabox' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'side',
				'high'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'article_info_data', 'article_info_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'article_info_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$field['id'],
						$field['id']
					);
					foreach ( $field['options'] as $key => $value ) {
						$field_value = !is_numeric( $key ) ? $key : $value;
						$input .= sprintf(
							'<option %s value="%s">%s</option>',
							$db_value === $field_value ? 'selected' : '',
							$field_value,
							$value
						);
					}
					$input .= '</select>';
					break;
				default:
					$input = sprintf(
						'<input id="%s" name="%s" type="%s" value="%s">',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= '<p>' . $label . '<br>' . $input . '</p>';
		}
		echo $output;
	}

	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['article_info_nonce'] ) )
			return $post_id;

		$nonce = $_POST['article_info_nonce'];
		if ( !wp_verify_nonce( $nonce, 'article_info_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'article_info_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'article_info_' . $field['id'], '0' );
			}
		}
	}
}
new Article_Meta_Box;

