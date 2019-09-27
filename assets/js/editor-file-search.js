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
			/*
			 * Use feature detection to determine whether inputs should use
			 * the `keyup` or `input` event. Input is preferred but lacks support
			 * in legacy browsers. See changeset 34078, see also ticket #26600#comment:59
			 */
			if ( 'oninput' in document.createElement( 'input' ) ) {
				inputEvent = 'input';
			} else {
				inputEvent = 'keyup';
			}

			$( document ).on( inputEvent, '#editor-files-search', 	EditorFileSearch._filterSearchFiles);
		},

		/**
		 * Filter Search Files
		 */
		_filterSearchFiles: function()
		{
			var parent      	= $('#templateside'),
				directories     = parent.find('ul ul li'),
				files           = parent.find('ul ul li a'),
				search_term     = $(this).val();

			if( search_term.length ) {

				// Expand all directories for search file.
				// Hide Directories. Because, Below we show those directories
				// which have search term in the file name.
				directories.attr('aria-expanded', true).hide();

				// Search file and ONLY show these directories which "contain" the file name.
				var rex = new RegExp( search_term, 'i');
		        files.filter(function () {
					var file_name = $.trim( $(this).text() ) || '';
		        	return rex.test( file_name );
		        }).parents('li').show();

			} else {
		
				// Collapse & show all directories.
				directories.attr('aria-expanded', false).show();
			}
		}

	};

	/**
	 * Initialize EditorFileSearch
	 */
	$(function(){
		EditorFileSearch.init();
	});

})(jQuery);