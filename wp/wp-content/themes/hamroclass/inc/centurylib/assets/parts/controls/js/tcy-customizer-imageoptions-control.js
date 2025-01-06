/**
 * tcy-customizer-icons-control.js
 *
 * @package themecentury
 * @subpackage DgLib
 * @version 1.0.0
 * @since 1.0.0
 *
 * Contains handlers to make Theme Customizer image options
 */
 ( function( $, customize ) {
    'use strict';
    var centurylib_document = $(document);
    var centurylib_window = $(window);
    var IMAGE_OPTION_CONTROL = {
        Snipits: {
            ImageOptions: function(){
                var wrapper_obj = $(this).closest('.tcy-imageoption-wrapper');
                var settings_object = wrapper_obj.find('.centurylib-imageoption-checkbox');
                var settings_value_obj = wrapper_obj.find('.centurylib-imageoption-value');
                var value_data = [];
                settings_object.each(function(){
                    if($(this).is(':checked')){
                        value_data.push($(this).val());     
                    }
                });
                var value_json = JSON.stringify(value_data);
                settings_value_obj.val(value_json);
                settings_value_obj.trigger('change');
            },
        },

        Events: function(){
            var __this = IMAGE_OPTION_CONTROL;
            var snipits = __this.Snipits;
            var imageoptions = snipits.ImageOptions;
            centurylib_document.on('change', '.tcy-imageoption-wrapper .centurylib-imageoption-checkbox', imageoptions);
        },

        Ready: function(){
            var __this = IMAGE_OPTION_CONTROL;
            var snipits = __this.Snipits;
            __this.Events();
        },

        Load: function(){
        },

        Resize: function(){
        },

        Scroll: function(){
        },

        Init: function(){
            var __this = IMAGE_OPTION_CONTROL;
            var load, ready, resize, scroll;
            ready = __this.Ready;
            load = __this.Load;
            resize = __this.Resize;
            scroll = __this.Scroll;
            centurylib_document.ready(ready);
            /*centurylib_window.load(load);
            centurylib_window.resize(resize);
            centurylib_window.scroll(scroll);*/

        },
    };
    IMAGE_OPTION_CONTROL.Init();
 } )( jQuery, wp.customize );
