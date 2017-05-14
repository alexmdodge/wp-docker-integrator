/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'ambition-color-scheme' ),
		colorSchemeKeys = [
			'ambition_buttons',
			'ambition_navigation_color',
			'ambition_promotionalbar',
			'ambition_links_color',
			//Background Color Options
			'top_contact_infobar_background',
			'site_title_logo_background',
			'site_title_navigation_background',
			'main_content_background',
			'featured_pg_background',
			'widgets_featured_recent_work_background',
			'services_background',
			'testimonial_background',
			'wid_clien_pro_background',
			'footer_widget_section_background',
			'bottom_contact_infobar_background',
			'site_info_background',
			'blockquote_sticky_background',
			'form_input_textfield_background',
			//Font Color Options
			'font_color_content',
			'font_color_top_infobar',
			'font_color_sitetitle',
			'font_color_navigation',
			'font_color_pagetitle_breadcrumbs',
			'font_color_slidertitle_content_button',
			'font_color_headings_titles',
			'font_color_sidebar_widget_titles',
			'font_color_pormotionalbar',
			'font_color_sidebar_content',
			'font_color_footer_widget_titles',
			'font_color_footer_content',
			'font_color_footer_infobar',
			'font_color_site_info',
			'font_color_siteinfo_links',

		],
		colorSettings = [
			'ambition_buttons',
			'ambition_navigation_color',
			'ambition_promotionalbar',
			'ambition_links_color',
			//Background Color Options
			'top_contact_infobar_background',
			'site_title_logo_background',
			'site_title_navigation_background',
			'main_content_background',
			'featured_pg_background',
			'widgets_featured_recent_work_background',
			'services_background',
			'testimonial_background',
			'wid_clien_pro_background',
			'footer_widget_section_background',
			'bottom_contact_infobar_background',
			'site_info_background',
			'blockquote_sticky_background',
			'form_input_textfield_background',
			//Font Color Options
			'font_color_content',
			'font_color_top_infobar',
			'font_color_sitetitle',
			'font_color_navigation',
			'font_color_pagetitle_breadcrumbs',
			'font_color_slidertitle_content_button',
			'font_color_headings_titles',
			'font_color_sidebar_widget_titles',
			'font_color_pormotionalbar',
			'font_color_sidebar_content',
			'font_color_footer_widget_titles',
			'font_color_footer_content',
			'font_color_footer_infobar',
			'font_color_site_info',
			'font_color_siteinfo_links',
		];

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {

					api( 'ambition_buttons' ).set( colorScheme[value].colors[3] );
					api.control( 'ambition_buttons' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'ambition_navigation_color' ).set( colorScheme[value].colors[3] );
					api.control( 'ambition_navigation_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'ambition_promotionalbar' ).set( colorScheme[value].colors[3] );
					api.control( 'ambition_promotionalbar' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );

					api( 'ambition_links_color' ).set( colorScheme[value].colors[3] );
					api.control( 'ambition_links_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[3] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[3] );
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(), css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		});
		// Add additional colors.
		colors.ambition_buttons = Color( colors.ambition_buttons ).toCSS();
		colors.ambition_navigation_color = Color( colors.ambition_navigation_color ).toCSS();
		colors.ambition_promotionalbar = Color( colors.ambition_promotionalbar ).toCSS();
		colors.ambition_links_color = Color( colors.ambition_links_color ).toCSS();
		css = cssTemplate( colors );

		colors.top_contact_infobar_background = Color( colors.top_contact_infobar_background ).toCSS();
		css = cssTemplate( colors );

		colors.site_title_logo_background = Color( colors.site_title_logo_background ).toCSS();
		css = cssTemplate( colors );

		colors.site_title_navigation_background = Color( colors.site_title_navigation_background ).toCSS();
		css = cssTemplate( colors );

		colors.main_content_background = Color( colors.main_content_background ).toCSS();
		css = cssTemplate( colors );

		colors.featured_pg_background = Color( colors.featured_pg_background ).toCSS();
		css = cssTemplate( colors );

		colors.widgets_featured_recent_work_background = Color( colors.widgets_featured_recent_work_background ).toCSS();
		css = cssTemplate( colors );

		colors.services_background = Color( colors.services_background ).toCSS();
		css = cssTemplate( colors );

		colors.testimonial_background = Color( colors.testimonial_background ).toCSS();
		css = cssTemplate( colors );

		colors.wid_clien_pro_background = Color( colors.wid_clien_pro_background ).toCSS();
		css = cssTemplate( colors );

		colors.footer_widget_section_background = Color( colors.footer_widget_section_background ).toCSS();
		css = cssTemplate( colors );

		colors.bottom_contact_infobar_background = Color( colors.bottom_contact_infobar_background ).toCSS();
		css = cssTemplate( colors );

		colors.site_info_background = Color( colors.site_info_background ).toCSS();
		css = cssTemplate( colors );

		colors.blockquote_sticky_background = Color( colors.blockquote_sticky_background ).toCSS();
		css = cssTemplate( colors );

		colors.form_input_textfield_background = Color( colors.form_input_textfield_background ).toCSS();
		css = cssTemplate( colors );

		//Font Color Options
		colors.font_color_content = Color( colors.font_color_content ).toCSS();
		css = cssTemplate( colors );

colors.font_color_top_infobar = Color( colors.font_color_top_infobar ).toCSS();
		css = cssTemplate( colors );

colors.font_color_sitetitle = Color( colors.font_color_sitetitle ).toCSS();
		css = cssTemplate( colors );

colors.font_color_navigation = Color( colors.font_color_navigation ).toCSS();
		css = cssTemplate( colors );

colors.font_color_pagetitle_breadcrumbs = Color( colors.font_color_pagetitle_breadcrumbs ).toCSS();
		css = cssTemplate( colors );

colors.font_color_slidertitle_content_button = Color( colors.font_color_slidertitle_content_button ).toCSS();
		css = cssTemplate( colors );

colors.font_color_headings_titles = Color( colors.font_color_headings_titles ).toCSS();
		css = cssTemplate( colors );

colors.font_color_sidebar_widget_titles = Color( colors.font_color_sidebar_widget_titles ).toCSS();
		css = cssTemplate( colors );

colors.font_color_pormotionalbar = Color( colors.font_color_pormotionalbar ).toCSS();
		css = cssTemplate( colors );

colors.font_color_sidebar_content = Color( colors.font_color_sidebar_content ).toCSS();
		css = cssTemplate( colors );

colors.font_color_footer_widget_titles = Color( colors.font_color_footer_widget_titles ).toCSS();
		css = cssTemplate( colors );

colors.font_color_footer_content = Color( colors.font_color_footer_content ).toCSS();
		css = cssTemplate( colors );

colors.font_color_footer_infobar = Color( colors.font_color_footer_infobar ).toCSS();
		css = cssTemplate( colors );

colors.font_color_site_info = Color( colors.font_color_site_info ).toCSS();
		css = cssTemplate( colors );

colors.font_color_siteinfo_links = Color( colors.font_color_siteinfo_links ).toCSS();
		css = cssTemplate( colors );


		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
