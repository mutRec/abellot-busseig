/**
 * tcy-customizer-repeater-control.js
 *
 * @package themecentury
 * @subpackage DgLib
 * @version 1.0.0
 * @since 1.0.0
 *
 * Contains handlers to make Theme Customizer repeater
 */
 ( function( $, centurylibcustomize ) {
 	'use strict';
 	var tcy_document = $(document);
 	var tcy_window = $(window);
 	var customizer_switch = {

 		Snipits:{

 			SwitchControl: function(evt){
 				var switch_single = $(this);
 				var switch_value = '';
 				var switch_wrapper = switch_single.closest('.tcy-customizer-switch-wrapper');
 				var switch_main_field = switch_wrapper.siblings('.tcy-customizer-switch-value');
 				if(switch_wrapper.hasClass('checkbox')){
 					var switch_array = [];
 					switch_wrapper.find('.tcy-switch-item').each(function(){
 						if( $(this).is(':checked') ){
 							var switch_value = $(this).val();
 							switch_array.push(switch_value);
 						}
 					});
 					switch_value = JSON.stringify(switch_array);
 				}else{
 					switch_value = switch_single.val();
 				}
 				switch_main_field.val(switch_value);
 				switch_main_field.trigger('change');
 			},
 		},

 		Click: function(){

 			var __this = customizer_switch;
 			var snipits = __this.Snipits;
 			var switchcontrol = snipits.SwitchControl;
 			tcy_document.on( 'change', '.tcy-switch-item', switchcontrol );

 		},

 		Ready: function(){
 			var __this = customizer_switch;
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

 			var __this = customizer_switch;
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

 	customizer_switch.Init();

 } )( jQuery, wp.customize );