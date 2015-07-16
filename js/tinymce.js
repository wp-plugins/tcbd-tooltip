(function() {
	tinymce.PluginManager.add('tcbd_mce_button', function( editor, url ) {
		editor.addButton( 'tcbd_mce_button', {
			icon: false,
			type: 'menubutton',
			title: 'TCBD Tooltip',
			image : url + '/icon.png',
			menu: [
				{
				text: 'TCBD Tooltip Link',
				onclick: function() {
					editor.windowManager.open( {
						title: 'TCBD Tooltip Link',
						body: [
							{
								type: 'textbox',
								name: 'linktitleBox',
								label: 'Link Title'
							},
							{
								type: 'textbox',
								name: 'tooltiptitleBox',
								label: 'Tooltip Title'
							},
							{
								type: 'textbox',
								name: 'urlBox',
								label: 'URL'
							},
							{
								type: 'listbox',
								name: 'placmentbox',
								label: 'Place',
								'values': [
									{text: 'Top', value: 'top'},
									{text: 'Bottom', value: 'bottom'},
									{text: 'Right', value: 'right'},
									{text: 'Left', value: 'left'}
								]
							}
						],
						onsubmit: function( e ) {
							editor.insertContent( '[tcbdtooltip_link title="' + e.data.tooltiptitleBox + '" url="' + e.data.urlBox + '" place="' + e.data.placmentbox + '"]' + e.data.linktitleBox + '[/tcbdtooltip_link]');
						}
					});
				}
				},
				{
				text: 'TCBD Tooltip Text',
				onclick: function() {
					editor.windowManager.open( {
						title: 'TCBD Tooltip Text',
						body: [
							{
								type: 'textbox',
								name: 'texttitleBox',
								label: 'Text'
							},
							{
								type: 'textbox',
								name: 'tooltiptitleBox',
								label: 'Tooltip Title'
							},
							{
								type: 'listbox',
								name: 'placmentbox',
								label: 'Place',
								'values': [
									{text: 'Top', value: 'top'},
									{text: 'Bottom', value: 'bottom'},
									{text: 'Right', value: 'right'},
									{text: 'Left', value: 'left'}
								]
							}
						],
						onsubmit: function( e ) {
							editor.insertContent( '[tcbdtooltip_text title="' + e.data.tooltiptitleBox + '" place="' + e.data.placmentbox + '"]' + e.data.texttitleBox + '[/tcbdtooltip_text]');
						}
					});
				}
				}
			]
		});
	});
})();