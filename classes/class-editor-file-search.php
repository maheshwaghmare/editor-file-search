<?php
/**
 * Editor File Search
 *
 * @package Editor File Search
 * @since 1.0.0
 */

if( ! class_exists( 'Editor_File_Search' ) ) :

	/**
	 * Editor File Search
	 *
	 * @since 1.0.0
	 */
	class Editor_File_Search {

		/**
		 * Instance
		 *
		 * @access private
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 * @return object initialized object of class.
		 */
		public static function set_instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'admin_head'            , array( $this, 'markup' ) );
			add_action( 'admin_enqueue_scripts' , array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Add Search Input
		 *
		 * @since 1.0.1 	Added multisite compatibility.
		 * @since 1.0.0
		 * @return void
		 */
		function markup() {
			if(
				'theme-editor' !== get_current_screen()->base &&
				'plugin-editor' !== get_current_screen()->base &&
				'theme-editor-network' !== get_current_screen()->base &&
				'plugin-editor-network' !== get_current_screen()->base
			) {
				return;
			}

			$placeholder = apply_filters( 'editor_file_search_input_placeholder', esc_html__( 'Search file...', 'editor-file-search' ) );
			?>
			<script type="text/template" id="tmpl-editor-file-search">
				<label for="editor-files-search" class="screen-reader-text"><?php echo esc_html( $placeholder ); ?></label>
				<input id="editor-files-search" name="editor-files-search" type="search" placeholder="<?php echo esc_html( $placeholder ); ?>" class="editor-file-search">
			</script>
			<?php
		}

		/**
		 * Enqueue Scripts
		 *
		 * @since 1.0.1 	Added multisite compatibility.
		 * @since 1.0.0
		 * @param  string $hook Current hook.
		 * @return void
		 */
		function enqueue_scripts( $hook = '' ) {
			if(
				'theme-editor' !== get_current_screen()->base &&
				'plugin-editor' !== get_current_screen()->base &&
				'theme-editor-network' !== get_current_screen()->base &&
				'plugin-editor-network' !== get_current_screen()->base
			) {
				return;
			}

			wp_enqueue_style( 'editor-file-search', EDITOR_FILE_SEARCH_URI . 'assets/css/editor-file-search.css', EDITOR_FILE_SEARCH_VER, true );
			wp_enqueue_script( 'editor-file-search', EDITOR_FILE_SEARCH_URI . 'assets/js/editor-file-search.js', array( 'wp-util', 'jquery' ), EDITOR_FILE_SEARCH_VER, true );
		}
	}

	/**
	 * Kicking this off by calling 'set_instance()' method
	 */
	Editor_File_Search::set_instance();

endif;	