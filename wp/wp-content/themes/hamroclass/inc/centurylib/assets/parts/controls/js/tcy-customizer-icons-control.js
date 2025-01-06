/**
 * tcy-customizer-icons-control.js
 *
 * @package themecentury
 * @subpackage DgLib
 * @version 1.0.0
 * @since 1.0.0
 *
 * Contains handlers to make Theme Customizer icons
 */
 ( function( $, customize ) {
 	'use strict';
 	var tcy_document = $(document);
 	var tcy_window = $(window);
 	var customizer_icons = {
 		Snipits: {

 			CustomizerIcons: function(){
 				var single_icon = $(this);
 				var tcy_custoimzer_icons = single_icon.closest( '.tcy-customize-icons' );
 				var icon_display_value = single_icon.children('i').attr('class');
 				var icon_split_value = icon_display_value.split(' ');
 				var icon_value = icon_split_value[1];

 				single_icon.siblings().removeClass('selected');
 				single_icon.addClass('selected');
 				tcy_custoimzer_icons.find('.tcy-icon-value').val( icon_value );
 				tcy_custoimzer_icons.find('.centurylib-icon-preview').html('<i class="' + icon_display_value + '"></i>');
 				tcy_custoimzer_icons.find('.tcy-icon-value').trigger('change');
 			},

 			IconsToggle: function(){
 				var icon_toggle = $(this);
 				var tcy_custoimzer_icons = icon_toggle.closest( '.tcy-customize-icons' );
 				var icons_list_wrapper = tcy_custoimzer_icons.find( '.tcy-icons-list-wrapper' );
 				var dashicons = tcy_custoimzer_icons.find( '.dashicons' );
 				if( icons_list_wrapper.is(':hidden') ){
 					icons_list_wrapper.slideDown();
 					dashicons.removeClass('dashicons-arrow-down');
 					dashicons.addClass('dashicons-arrow-up');
 				}else{
 					icons_list_wrapper.slideUp();
 					dashicons.addClass('dashicons-arrow-down');
 					dashicons.removeClass('dashicons-arrow-up');
 				}
 			}, 

 			IconsSearch: function(){
 				var text = $(this),
 				value = this.value,
 				tcy_custoimzer_icons = text.closest( '.tcy-customize-icons' ),
 				icons_list_wrapper = tcy_custoimzer_icons.find( '.tcy-icons-list-wrapper' );

 				icons_list_wrapper.find('i').each(function () {
 					if ($(this).attr('class').search(value) > -1) {
 						$(this).parent('.tcy-single-icon').show();
 					} else {
 						$(this).parent('.tcy-single-icon').hide();

 					}
 				});
 			},


 		},

 		Click: function(){

 			var __this = customizer_icons;
 			var snipits = __this.Snipits;

 			var customizericons = snipits.CustomizerIcons;
 			tcy_document.on('click', '.tcy-customize-icons .tcy-single-icon', customizericons);

 			var iconstoggle = snipits.IconsToggle;
 			tcy_document.on('click', '.tcy-customize-icons .tcy-icon-toggle, .tcy-customize-icons .centurylib-icon-preview', iconstoggle);

 			var iconssearch = snipits.IconsSearch;
 			tcy_document.on('keyup', '.tcy-customize-icons .icon-search', iconssearch);

 		},

 		Ready: function(){
 			var __this = customizer_icons;
 			var snipits = __this.Snipits;
 			__this.Click();
 		},

 		Load: function(){
 		},

 		Resize: function(){
 		},

 		Scroll: function(){
 		},

 		Init: function(){

 			var __this = customizer_icons;
 			var load, ready, resize, scroll;

 			ready = __this.Ready;
 			load = __this.Load;
 			resize = __this.Resize;
 			scroll = __this.Scroll;
 			tcy_document.ready(ready);
 			/*tcy_window.load(load);
 			tcy_window.resize(resize);
 			tcy_window.scroll(scroll);*/

 		},

 	};

 	customizer_icons.Init();

 } )( jQuery, wp.customize );