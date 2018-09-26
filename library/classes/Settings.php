<?php

namespace LuuptekWP;

class Settings {

	/**
	 * Default Option key
	 * @var string
	 */
	private $key = 'luuptek_wp_base_options';

	/**
	 * Array of metaboxes/fields
	 * @var array
	 */
	protected $option_metabox = [ ];

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Tab Pages
	 * @var array
	 */
	protected $options_pages = [ ];

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->title = __( 'Theme Options', TEXT_DOMAIN );
	}

	/**
	 * Initiate our hooks
	 */
	public function hooks() {
		add_action( 'admin_init', [ $this, 'init' ] );
		add_action( 'admin_menu', [ $this, 'add_options_page' ] ); //create tab pages
	}

	/**
	 * Register the setting tabs to WP
	 */
	public function init() {
		$option_tabs = self::option_fields();
		foreach ( $option_tabs as $index => $option_tab ) {
			register_setting( $option_tab['id'], $option_tab['id'] );
		}
	}

	/**
	 * Add menu options page
	 */
	public function add_options_page() {
		$option_tabs = self::option_fields();
		foreach ( $option_tabs as $index => $option_tab ) {
			if ( $index == 0 ) {
				$this->options_pages[] = add_menu_page( $this->title, $this->title, 'manage_options', $option_tab['id'],
					[ $this, 'admin_page_display' ], 'dashicons-admin-tools' ); //Link admin menu to first tab
				add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options',
					$option_tab['id'], [ $this, 'admin_page_display' ] ); //Duplicate menu link for first submenu page
			} else {
				$this->options_pages[] = add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'],
					'manage_options', $option_tab['id'], [ $this, 'admin_page_display' ] );
			}
		}
	}

	/**
	 * Admin page markup. Mostly handled by CMB
	 */
	public function admin_page_display() {
		$option_tabs = self::option_fields();
		$tab_forms   = [ ];
		?>
		<div class="wrap cmb_options_page <?php echo $this->key; ?>">
			<h2><i class="fa fa-globe"></i> <?php echo esc_html( get_admin_page_title() ); ?></h2>

			<h2 class="nav-tab-wrapper">
				<?php foreach ( $option_tabs as $option_tab ) :
					$tab_slug = $option_tab['id'];
					$nav_class = 'nav-tab';
					if ( $tab_slug == $_GET['page'] ) {
						$nav_class .= ' nav-tab-active';
						$tab_forms[] = $option_tab;
					}
					?>
					<a class="<?php echo $nav_class; ?>"
					   href="<?php menu_page_url( $tab_slug ); ?>"><?php esc_attr_e( $option_tab['title'] ); ?></a>
				<?php endforeach; ?>
			</h2>


			<?php foreach ( $tab_forms as $tab_form ) : //render all tab forms (normaly just 1 form) ?>
				<div id="<?php esc_attr_e( $tab_form['id'] ); ?>" class="group">
					<?php cmb2_metabox_form( $tab_form, $tab_form['id'] ); ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Defines the theme option metabox and field configuration
	 *
	 * @return array
	 */
	public function option_fields() {

		if ( ! empty( $this->option_metabox ) ) {
			return $this->option_metabox;
		}

		/**
		 * General options
		 */
		$this->option_metabox[] = [
			'id'         => 'luuptek_wp_base_general_options',
			'title'      => __( 'General options', TEXT_DOMAIN ),
			'show_on'    => [ 'key' => 'options-page', 'value' => [ 'luuptek_wp_base_general_options' ], ],
			'show_names' => true,
			'fields'     => [
				[
					'name'    => __( 'Tag-manager head', TEXT_DOMAIN ),
					'desc'    => __( 'Add here the full Tag-manager -snippet that goes to head.', TEXT_DOMAIN ),
					'id'      => 'luuptek_wp_base_tagmanager_head',
					'default' => '',
					'type'    => 'textarea_code',
				],
				[
					'name'    => __( 'Tag-manager body', TEXT_DOMAIN ),
					'desc'    => __( 'Add here the full Tag-manager -snippet that goes to beginning of body.', TEXT_DOMAIN ),
					'id'      => 'luuptek_wp_base_tagmanager_body',
					'default' => '',
					'type'    => 'textarea_code',
				],
				[
					'name'    => __( 'Default post image', TEXT_DOMAIN ),
					'desc'    => __( 'define default post image if no images are attached to post / page',
						TEXT_DOMAIN ),
					'id'      => 'luuptek_wp_base_default_image',
					'default' => '',
					'type'    => 'file',
				],
			]
		];

		$this->option_metabox[] = [
			'id'         => 'luuptek_wp_base_advanced_options',
			'title'      => __( 'Advanced Settings', TEXT_DOMAIN ),
			'show_on'    => [ 'key' => 'options-page', 'value' => [ 'advanced_options' ], ],
			'show_names' => true,
			'fields'     => [
				[
					'name'    => __( 'Some code-area', TEXT_DOMAIN ),
					'desc'    => __( 'Add here some code, which will be rendered somewhere', TEXT_DOMAIN ),
					'id'      => 'luuptek_wp_base_codearea',
					'default' => '',
					'type'    => 'textarea_code',
				],
			]
		];

		return $this->option_metabox;
	}

	/**
	 * Returns the option key for a given field id
	 *
	 * @param $field_id
	 *
	 * @return string
	 */
	public function get_option_key( $field_id ) {
		$option_tabs = $this->option_fields();
		foreach ( $option_tabs as $option_tab ) { //search all tabs
			foreach ( $option_tab['fields'] as $field ) { //search all fields
				if ( $field['id'] == $field_id ) {
					return $option_tab['id'];
				}
			}
		}

		return $this->key; //return default key if field id not found
	}

	/**
	 * @param $field
	 *
	 * @return array
	 * @throws Exception
	 */
	public function __get( $field ) {

		// Allowed fields to retrieve
		if ( in_array( $field, [ 'key', 'fields', 'title', 'options_pages' ], true ) ) {
			return $this->{$field};
		}
		if ( 'option_metabox' === $field ) {
			return $this->option_fields();
		}

		throw new Exception( 'Invalid property: ' . $field );
	}
}

/**
 * Only construct class if CMB2 is loaded
 */
if ( defined( 'CMB2_LOADED' ) ) :

	$admin = new Settings;
	$admin->hooks();

	/**
	 *
	 * helper to get option values
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	function get_settings_field( $key = '' ) {
		global $admin;

		return cmb2_get_option( $admin->get_option_key( $key ), $key );
	}

endif;

?>
