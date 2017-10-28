(function($){

	EditorFileSearch = {

		/**
		 * Init
		 */
		init: function()
		{
			this._addFileSearchInput();
			this._bind();
		},

		/**
		 * Add File Search Input
		 */
		_addFileSearchInput: function() {

			var template = wp.template('editor-file-search');

			if( $('#theme-files-label').length ) {
				$('#theme-files-label').after( template );
			}

			if( $('#plugin-files-label').length ) {
				$('#plugin-files-label').after( template );
			}

		},
		
		/**
		 * Binds the events
		 */
		_bind: function()
		{
			$( document ).on('keyup', '#theme-files-search', 	EditorFileSearch._filterSearchFiles);
		},

		/**
		 * Filter Search Files
		 */
		_filterSearchFiles: function()
		{
			var parent      = $('#templateside');
			var directories = parent.find('ul ul li');
			var files       = parent.find('ul ul li a');

			// Expand all directories.
			directories.attr('aria-expanded', true);

			// Hide Directories. Becuase, Below we show those directories
			// which have search term in the file name.
	        directories.hide();

			// Search file and ONLY show these directories which "contain" the file name.
			var rex = new RegExp( $(this).val(), 'i');
	        files.filter(function () {
				var file_name = $.trim( $(this).text() ) || '';
	        	return rex.test( file_name );
            }).parents('li').show();

		}

	};

	/**
	 * Initialize EditorFileSearch
	 */
	$(function(){
		EditorFileSearch.init();
	});

})(jQuery);