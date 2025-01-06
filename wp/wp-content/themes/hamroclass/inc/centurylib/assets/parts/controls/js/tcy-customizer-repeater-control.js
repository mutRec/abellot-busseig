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
( function( $, customize ) {
	'use strict';

	var tcy_document = $(document);
	var tcy_window = $(window);
	var customizer_repeater = {
		Snipits: {

			Generate_Value: function(length){

 				var id_attr = "";
 				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
 				for (var i = 0; i < length; i++){
 					id_attr += possible.charAt( Math.floor( Math.random() * possible.length ) );
 				}
 				return id_attr;

 			},

 			RepeaterToggle: function(){
 				$(this).next().slideToggle();
 				$(this).closest('.centurylib-main-repeater-field-control').toggleClass('expanded');
 			},

 			RepeaterClose: function(){
 				$(this).closest('.repeater-fields').slideUp();
 				$(this).closest('.centurylib-main-repeater-field-control').toggleClass('expanded');
 			},

 			RemoveRepeaterField: function(evt){
 				var snipits = customizer_repeater.Snipits;
 				var repeater_wrap_control = $(this).closest( ".centurylib-main-repeater-field-wrap-control" );
 				if( typeof	$(this).parent() != 'undefined'){
 					$(this).closest('.centurylib-main-repeater-field-control').slideUp('normal', function(){
 						$(this).remove();
 						snipits.RefreshRepeaterValues( repeater_wrap_control );
 					});
 				}
 				return false;
 			},

 			RefreshRepeaterValues: function( __this ){
 				__this = __this || '';
 				var tcy_repeater_field_wrap_control = ( __this ) ? __this : $( ".centurylib-main-repeater-field-wrap-control" );
 				tcy_repeater_field_wrap_control.each(function(){
 					var values = [];
 					var $this = $(this);
 					$this.find(".centurylib-main-repeater-field-control").each(function(){
 						var valueToPush = {};
 						var dataValue;
 						$(this).find('[data-name]').each(function(){
 							if( $(this).attr('type') === 'checkbox'){
 								dataValue = ( $(this).is(':checked') ) ? 1 : '';
 							}else if( $(this).attr('type') === 'radio' ){
 								dataValue = ( $(this).is(':checked') ) ? $(this).val() : '';
 								if(dataValue.length==0){
 									return;
 								}
 							}else{
 								dataValue = $(this).val();
 							}
 							var dataName = $(this).attr('data-name');
 							valueToPush[dataName] = dataValue;
 						});
 						values.push(valueToPush);
 					});
 					console.log(values);
 					$this.next('.centurylib-main-repeater-collection').val(JSON.stringify(values)).trigger('change');
 				});

 			},

 			RepeaterControl: function(){
 				
 				var $this = $(this).parent();
 				var snipits = customizer_repeater.Snipits;
 				var generated_val = snipits.Generate_Value(5);
 				if(typeof $this !== 'undefined') {
 					var field = $this.find(".centurylib-main-repeater-field-generator").html();
 					field = $($.parseHTML(field));
 					if(typeof field !== 'undefined'){
 						field.find("input[type='text'][data-name]").each(function(){
 							var defaultValue = $(this).attr('data-default');
 							$(this).val(defaultValue);
 							if($(this).hasClass('tcy-color-picker')){
	 							var color_picker_option = {
	 								change: function(event, ui){
	 									var theColor = ui.color.toString();
	 									console.log( 'Color is ' + theColor);
	 									$(this).val(theColor);
	 								},
	 							};
	 							$(this).wpColorPicker(color_picker_option);
 							}
 						});
 						field.find("input[type='radio'][data-name]").each(function(){
 							var radio_id = $(this).attr('id');
 							var radio_name = $(this).attr('name');
 							var new_id_attr = radio_id + '_' + generated_val;
 							var new_name_attr = radio_name + '_' + generated_val;
 							$(this).attr( 'id', new_id_attr );
 							$(this).siblings('label').attr( 'for', new_id_attr );
 							$(this).attr( 'name', new_name_attr );
 						});
 						field.find("textarea[data-name]").each(function(){
 							var defaultValue = $(this).attr('data-default');
 							$(this).val(defaultValue);
 						});
 						field.find("select[data-name]").each(function(){
 							var defaultValue = $(this).attr('data-default');
 							$(this).val(defaultValue);
 						});

 						field.find('.single-field').show();

 						$this.find('.centurylib-main-repeater-field-wrap-control').append(field);

 						field.addClass('expanded').find('.repeater-fields').show();
 						$('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
 						snipits.RefreshRepeaterValues( $this.find('.centurylib-main-repeater-field-wrap-control') );
 					}

 				}

 				return false;
 			},

 		},

 		Click: function(){

 			var __this = customizer_repeater;
 			var snipits = __this.Snipits;

 			var repeatertoggle = snipits.RepeaterToggle;
 			tcy_document.on('click','.repeater-field-title', repeatertoggle);

 			var repeaterclose = snipits.RepeaterClose;
 			tcy_document.on('click','.repeater-field-close', repeaterclose);

 			var repeatercontrol = snipits.RepeaterControl;
 			tcy_document.on('click','.centurylib-main-repeater-add-control-field', repeatercontrol);

 			var removerepeaterfield = snipits.RemoveRepeaterField;
 			tcy_document.on("click", ".repeater-field-remove", removerepeaterfield);

 			tcy_document.on('keyup change', '[data-name]', function(){
 				var wraper_control = $(this).closest( ".centurylib-main-repeater-field-wrap-control" );
 				snipits.RefreshRepeaterValues(wraper_control);
 				return false;
 			});
 			$(".centurylib-main-repeater-field-wrap-control").sortable({
 				orientation: "vertical",
 				update: function( event, ui ) {
 					snipits.RefreshRepeaterValues();
 				}
 			});

 		},

 		Ready: function(){
 			var __this = customizer_repeater;
 			var snipits = __this.Snipits;
 			__this.Click();
 			snipits.RepeaterToggle();
 		},

 		Load: function(){
 		},

 		Resize: function(){
 		},

 		Scroll: function(){
 		},

 		Init: function(){

 			var __this = customizer_repeater;
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

 	customizer_repeater.Init();

 } )( jQuery, wp.customize );