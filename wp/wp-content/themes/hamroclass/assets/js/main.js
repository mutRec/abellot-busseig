/**
 * hamroclass custom.js
 *
 * @package themecentury
 * @subpackage hamroclass
 * @version 1.0.0
 *
 * Contains handlers to make hamroclass WordPress theme custom javascript
 */
 ( function( $ ) {

 	'use strict';
 	var hmc_document = $(document);
 	var hmc_window = $(window);
 	var hamroclass = {

 		Snipits:{

            Variables: function(){
                //Write your global variable here
            },

 			AppendData: function(){
 				//responsive sub menu toggle
 				$( '#site-navigation .menu-item-has-children, #site-navigation .page_item_has_children').append( '<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>' );
 			},

 			Preloader: function(){
			    var preloader = $('#hamroclass_preloader_wrapper');
			    preloader.remove();
 			},

 			VisibilityScroller: function(){
 				if($(this).scrollTop()>1000){
 					$('#hmc-scrollup').fadeIn('slow');
 				}else{
 					$('#hmc-scrollup').fadeOut('slow');
 				}
 			},

 			ScrollTop: function(evt){
 				$("html, body").animate({
 					scrollTop: 0
 				}, 600);
 				return false;
 			},

 			SearchToggle: function(evt){
 				$('.search-form-main').toggleClass('active-search');
 				$('.search-form-main .search-field').focus();
 			},

 			MenuToggle: function(evt){
 				$('.hmc-header-menu-wrapper #site-navigation').slideToggle('slow');
 			},

 			SubToggle: function( evt ){

 				$(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
 				$(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
 				$(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
                
 			},

 			Sliders: function(){

 				/**
				 * Notice script
				 */
                var $notice_obj = $('#newsNotice');
                if($notice_obj.length){
                    var noticeArgs = $notice_obj.data( 'notice' );
                    noticeArgs.onSliderLoad = function () {
                        $('#hmc-newsNotice').removeClass('cS-hidden');
                    };
                    noticeArgs.prevHtml = '<i class="fa fa-chevron-left"></i>';
                    noticeArgs.nextHtml = '<i class="fa fa-chevron-right"></i>';
                    $notice_obj.lightSlider(noticeArgs);

                    $('.video-button a').magnificPopup({
                        disableOn: 700,
                        type: 'iframe',
                        mainClass: 'mfp-fade',
                        removalDelay: 160,
                        preloader: false,
                        fixedContentPos: false
                    });
                }
				/**
				 * Block carousel layout
				 */
				$( '.hamroclass-block-carousel' ).each(function(){
                    
                    var this_carousel = $(this);
                    var carousel_args = this_carousel.data('carousel');
                    if( this_carousel.closest('.widget-area').hasClass('sidebar-main-area') ){
                       carousel_args.item=1;
                    }
                    if( this_carousel.closest('.widget-area').hasClass('footer-sidebar-area') ){
                       carousel_args.item=1;
                    }
                    carousel_args.onSliderLoad = function(){
                        this_carousel.removeClass('cS-hidden');
                    }
                    var carousel_obj = this_carousel.lightSlider(carousel_args);
                    var carousel_wrapper = this_carousel.closest('.hmc-block-posts-wrapper');
                    carousel_wrapper.find('.hmc-navPrev').click(function () {
                        carousel_obj.goToPrevSlide();
                    });
                    carousel_wrapper.find('.hmc-navNext').click(function () {
                        carousel_obj.goToNextSlide();
                    });

                });

                $( '.hamroclass-main-banner' ).each(function(){
                    
                    var this_banner = $(this);
                    var banner_args = this_banner.data('carousel');
                    banner_args.onSliderLoad = function(){
                        this_banner.removeClass('cS-hidden');
                    }
                    var carousel_obj = this_banner.lightSlider(banner_args);
                    var carousel_wrapper = this_banner.closest('.main-banner-slider-wrapper');
                    carousel_wrapper.find('.cycle-prev').click(function () {
                        carousel_obj.goToPrevSlide();
                    });
                    carousel_wrapper.find('.cycle-next').click(function () {
                        carousel_obj.goToNextSlide();
                    });

                });

 			},

            TabbedWidget: function(evt){
                
                evt.preventDefault();

                if($(this).closest('li').hasClass('active-item')){
                    return;
                }
                
                var tabbed_content_id = $(this).attr( 'href' );
                var tabbed_wrapper = $(this).closest('.hmc-default-tabbed-wrapper');

                tabbed_wrapper.find( 'li' ).removeClass( 'active-item' );
                $(this).closest('li').addClass( 'active-item' );

                tabbed_wrapper.find('.hmc-tabbed-section').removeClass('active-content');
                $(tabbed_content_id).addClass('active-content');

            },

 			Widget_Title_Tab: function(evt){

                evt.preventDefault();
                var tab_item = $(this);
                if( tab_item.closest( '.wdgt-tab-term' ).hasClass( 'active-item' ) ){
                    return;
                }
                var widget_title_tabs =  tab_item.closest('.wdgt-title-tabs');
                if( widget_title_tabs.attr( 'data-loading' ) == 1 ){
                    return;
                }

                var tab_content_class = tab_item.data('tab');
                var widget_title = tab_item.closest('.hamroclass-block-title');
                var block_post_widget = tab_item.closest('.widget');
                
                widget_title_tabs.find('.wdgt-tab-term').removeClass('active-item');
                tab_item.closest('li').addClass('active-item');
                block_post_widget.find('.hmc-block-posts-wrapper').removeClass( 'tab-active' );
                if( block_post_widget.find( '.' + tab_content_class ).length ){
                    block_post_widget.find( '.' + tab_content_class ).addClass( 'tab-active' );
                    return;
                }
                var ajax_args = $(this).data('ajax-args');
                ajax_args.beforeSend = function(){
                    widget_title_tabs.attr( 'data-loading', 1 );
                    block_post_widget.find('.hmrcls-wdgt-preloader').removeClass('hidden');
                };
                ajax_args.success = function(data, status, settings){
                    widget_title_tabs.attr( 'data-loading', 0 );
                    block_post_widget.find('.hmrcls-wdgt-preloader').addClass('hidden');
                    var widget_html = data.widget_html;
                    if(widget_html){
                        block_post_widget.find('.centurylib-tab-alldata').after(widget_html);
                    }else{
                        console.warn('Sorry faild to retrive widget html data on ajax call');    
                    }
                };
                ajax_args.fail = function( xhr, textStatus, errorThrown ){
                    widget_title_tabs.attr( 'data-loading', 0 );
                    console.warn('Sorry faild widget tab ajax call');
                };
                $.ajax(ajax_args);                

            },
            Accessibility: function () {

                var main_menu_container = $('#site-navigation');
                main_menu_container.find('li.menu-item').focusin(function () {
                    if (!$(this).hasClass('menu-item-focused')) {
                        $(this).addClass('menu-item-focused');
                    }
                });
                main_menu_container.find('li.menu-item').focusout(function () {
                    $(this).removeClass('menu-item-focused');
                });
                
            },

 		},

 		Events: function(){

 			var __this = hamroclass;
 			var snipits = __this.Snipits;

            snipits.Accessibility();

 			var widget_title_tab = snipits.Widget_Title_Tab;
            hmc_document.on( 'click', '.dgwidgt-title-tab', widget_title_tab );

 			var hamroclass_scroll_top = snipits.ScrollTop;
 			$('#hmc-scrollup').on('click', hamroclass_scroll_top);

 			var hamroclass_search_toggle = snipits.SearchToggle;
 			$( '.hmc-header-search-wrapper .search-main' ).on( 'click', hamroclass_search_toggle );

 			//responsive menu toggle
 			var hamroclass_menu_toggle = snipits.MenuToggle;
 			$('.hmc-header-menu-wrapper .menu-toggle').on( 'click', hamroclass_menu_toggle );

 			var hamroclass_subtoggle = snipits.SubToggle;
 			hmc_document.on( 'click', '#site-navigation .sub-toggle', hamroclass_subtoggle );

            var tabbed_widget = snipits.TabbedWidget;
            hmc_document.on( 'click', '.hmc-widget-tab a', tabbed_widget );
 		},

 		Ready: function(){

 			var __this = hamroclass;
 			var snipits = __this.Snipits;
            snipits.Variables();
 			__this.Events();
 			snipits.AppendData();
 			snipits.ScrollTop();
 			snipits.Sliders();
 		},

 		Load: function(){

            var __this = hamroclass;
            var snipits = __this.Snipits;
            snipits.Preloader();
            
 		},

 		Resize: function(){
 		},

 		Scroll: function(){
 			var __this = hamroclass;
 			var snipits = __this.Snipits;
 			snipits.VisibilityScroller();
 		},

 		Init: function(){

 			var __this = hamroclass;
 			var load, ready, resize, scroll;

 			ready = __this.Ready;
 			load = __this.Load;
 			resize = __this.Resize;
 			scroll = __this.Scroll;
 			
 			hmc_document.ready(ready);
 			hmc_window.load(load);
 			hmc_window.resize(resize);
 			hmc_window.scroll(scroll);

 		},

 	};


 	hamroclass.Init();

    
 } )( jQuery );