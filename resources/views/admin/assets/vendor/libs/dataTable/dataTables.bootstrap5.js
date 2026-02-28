

(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		
		define( ['jquery', 'datatables.net'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		
		var jq = require('jquery');
		var cjsRequires = function (root, $) {
			if ( ! $.fn.dataTable ) {
				require('datatables.net')(root, $);
			}
		};

		if (typeof window === 'undefined') {
			module.exports = function (root, $) {
				if ( ! root ) {
					
					
					root = window;
				}

				if ( ! $ ) {
					$ = jq( root );
				}

				cjsRequires( root, $ );
				return factory( $, root, root.document );
			};
		}
		else {
			cjsRequires( window, jq );
			module.exports = factory( jq, window, window.document );
		}
	}
	else {
		
		factory( jQuery, window, document );
	}
}(function( $, window, document ) {
'use strict';
var DataTable = $.fn.dataTable;






$.extend( true, DataTable.defaults, {
	renderer: 'bootstrap'
} );



$.extend( true, DataTable.ext.classes, {
	container: "dt-container dt-bootstrap5",
	search: {
		container: "dt-search input-group input-group-merge",
		input: "form-control me-auto",
	},
	length: {
		select: "form-select ms-auto"
	},
	processing: {
		container: "dt-processing card"
	},
	layout: {
		row: 'row justify-content-between',
		cell: 'd-md-flex justify-content-between align-items-center',
		tableCell: 'col-12',
		start: 'dt-layout-start col-md-auto ms-3',
		end: 'dt-layout-end col-md-auto me-3',
		full: 'dt-layout-full col-md'
	}
} );



DataTable.ext.renderer.pagingButton.bootstrap = function (settings, buttonType, content, active, disabled) {
	var btnClasses = ['dt-paging-button', 'page-item'];

	if (active) {
		btnClasses.push('active');
	}

	if (disabled) {
		btnClasses.push('disabled')
	}

	var li = $('<li>').addClass(btnClasses.join(' '));
	var a = $('<button>', {
		'class': 'page-link',
		role: 'link',
		type: 'button'
	})
		.html(content)
		.appendTo(li);

	return {
		display: li,
		clicker: a
	};
};

DataTable.ext.renderer.pagingContainer.bootstrap = function (settings, buttonEls) {
	return $('<ul/>').addClass('pagination').append(buttonEls);
};


return DataTable;
}));
