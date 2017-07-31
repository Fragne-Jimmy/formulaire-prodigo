(function() {	
	tinymce.create('tinymce.plugins.vuzzShortcodeMce', {
		init : function(ed, url){
			tinymce.plugins.vuzzShortcodeMce.theurl = url;
		},
		createControl : function(btn, e) {
			if ( btn == "vuzz_shortcodes_button" ) {
				var a = this;	
				var btn = e.createSplitButton('vuzz_button', {
	                title: "Insert Shortcode",
					image: tinymce.plugins.vuzzShortcodeMce.theurl +"/images/shortcodes.png",
					icons: false,
	            });
	            btn.onRenderMenu.add(function (c, b) {					
					a.render( b, "Accordion", "accordion" );
					a.render( b, "Alerts", "alert" );
					a.render( b, "Boxes", "box" );
					a.render( b, "Buttons", "button" );
					a.render( b, "Clear Floats", "clear" );
					a.render( b, "Columns", "column" );
					a.render( b, "Column half", "columnhalf" );
					a.render( b, "Column half last", "columnhalflast" );
					a.render( b, "Countdown", "countdown" );
					a.render( b, "Contact", "contact" );					
					a.render( b, "Divider", "divider" );
					a.render( b, "Embed video", "video" );
					a.render( b, "Google map", "map" );
					a.render( b, "Panel", "panel" );
					a.render( b, "Pricing", "pricing" );					
					a.render( b, "Slider", "slider" );					
					a.render( b, "Social Icons", "social" );
					a.render( b, "Spacing", "spacing" );
					a.render( b, "Tabs", "tabs" );
					a.render( b, "Teambox", "teambox" );
					a.render( b, "Title", "title" );
					a.render( b, "Title small", "titlesmall" );
					a.render( b, "Toggle", "toggle" );
					a.render( b, "WP Gallery", "wpgal" );
				});
	            
	          return btn;
			}
			return null;               
		},
		render : function(ed, title, id) {
			ed.add({
				title: title,
				onclick: function () {
					
					// Accordion
					if(id == "accordion") {
						tinyMCE.activeEditor.selection.setContent('[vazz_accordion]<br />[vazz_accordion_section title="Section 1"]<br />Accordion Content<br />[/vazz_accordion_section]<br />[vazz_accordion_section title="Section 2"]<br />Accordion Content<br />[/vazz_accordion_section]<br />[/vazz_accordion]');
					}
					
					// Alert
					if(id == "alert") {
						tinyMCE.activeEditor.selection.setContent('[vazz_alert color="default/blue/green/gray/red" text="hello"]');
					}
					
					// Box
					if(id == "box") {
						tinyMCE.activeEditor.selection.setContent('[vazz_box color="olive/blue/green/red/gray/yellow/white" float="none" text_align="center" width="100%"]' + tinyMCE.activeEditor.selection.getContent() + '[/vazz_box]');
					}
					
					// Button
					if(id == "button") {
						tinyMCE.activeEditor.selection.setContent('[vazz_button type="square/round" size="small/medium/big" color="blue/green/orange/black/violet/red/yellow/teal" fancy="shadow/noshadow" url="#" text="Download"]');
					}
					
					// Clear Floats
					if(id == "clear") {
						tinyMCE.activeEditor.selection.setContent('[vazz_clear]');
					}
					
					// Column
					if(id == "column") {						
						tinyMCE.activeEditor.selection.setContent('[column columns="4"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');						
					}
					
					// Column Half
					if(id == "columnhalf") {						
						tinyMCE.activeEditor.selection.setContent('[halfcolumn]' + tinyMCE.activeEditor.selection.getContent() + '[/halfcolumn]');						
					}
					
					// Column Half Last
					if(id == "columnhalflast") {						
						tinyMCE.activeEditor.selection.setContent('[halfcolumnlast]' + tinyMCE.activeEditor.selection.getContent() + '[/halfcolumnlast]');						
					}
					
					// Countdown
					if(id == "countdown") {
						tinyMCE.activeEditor.selection.setContent('[vazz_countdown event="Black Friday" month="9" day="30" year="2013" /]');
					}
					
					// Contact
					if(id == "contact") {
						tinyMCE.activeEditor.selection.setContent('[vazz_contact email=youraddress@email.com]');
					}
					
					// Divider
					if(id == "divider") {
						tinyMCE.activeEditor.selection.setContent('[vazz_divider]');
					}
					
					// Embed audio
					if(id == "audio") {
						tinyMCE.activeEditor.selection.setContent('[vazz_audio5 src="youraudiolink" loop="true" autoplay="autoplay" preload="auto" loop="loop" controls=""]');
					}
					
					// Embed video
					if(id == "video") {
						tinyMCE.activeEditor.selection.setContent('[vazz_vid site="youtube/vimeo/dailymotion/yahoo/bliptv/veoh/viddler" id="dQw4w9WgXcQ" w="100%" h="360"]');
					}
					
					// Google Map
					if(id == "map") {
						tinyMCE.activeEditor.selection.setContent('[vazz_googlemap src="Your Map Full Url"]');
					}
					
					// Panel
					if(id == "panel") {
						tinyMCE.activeEditor.selection.setContent('[vazz_panel]' + tinyMCE.activeEditor.selection.getContent() + '[/vazz_panel]');
					}
					
					// Pricing
					if(id == "pricing") {
						tinyMCE.activeEditor.selection.setContent('[vazz_pricing_table size="four columns"]<br/>[vazz_pricing plan="Gold" cost="$29.99" per="per month" button_url="#" button_text="Sign Up" button_color="teal" button_border_radius="" button_target="self" button_rel="nofollow"]<ul><li>5 products</li><li>1 image per product</li><li>basic stats</li><li>non commercial</li></ul>[/vazz_pricing]<br/>[/vazz_pricing_table]');
					}
					
					//Slider
					if(id == "slider") {
						tinyMCE.activeEditor.selection.setContent('[vazz_slider][vazz_image link="pic1.jpg"][vazz_image link="pic2.jpg"][vazz_image link="pic3.jpg][/vazz_slider]');
					}
					
					//Social
					if(id == "social") {
						tinyMCE.activeEditor.selection.setContent('[vazz_social network="facebook/twitter/google/dribbble/vimeo/skype/rss/linkedin/pinterest" profilelink="linkhere"]');
					}
					
					//Spacing
					if(id == "spacing") {
						tinyMCE.activeEditor.selection.setContent('[vazz_spacing size="20px"]');
					}					
					
					//Tabs
					if(id == "tabs") {
						tinyMCE.activeEditor.selection.setContent('[vazz_tabgroup]<br/>[vazz_tab title="Title 1"]Content 1[/vazz_tab]<br/>[vazz_tab title="Title 2"]Content 2[/vazz_tab]<br/>[/vazz_tabgroup]');
					}
					
					//Teambox
					if(id == "teambox") {
						tinyMCE.activeEditor.selection.setContent('[vazz_teambox name="John Doe" imagelink="image.jpg"]content and social shortcode here[/vazz_teambox]');
					}
					
					// Title
					if(id == "title") {						
						tinyMCE.activeEditor.selection.setContent('[vazz_title text="text here"]');						
					}
					
					// Title Small
					if(id == "titlesmall") {						
						tinyMCE.activeEditor.selection.setContent('[vazz_smalltitle text="hello"]');						
					}
					
					//Toggle
					if(id == "toggle") {
						tinyMCE.activeEditor.selection.setContent('[vazz_toggle title="Your title or question"]Your content or answer[/vazz_toggle]');
					}
				
					// WP Gallery
					if(id == "wpgal") {						
						tinyMCE.activeEditor.selection.setContent('[gallery link="file" columns="4"]');						
					}
					
					return false;
				}
			})
		}
	
	});
	tinymce.PluginManager.add("vuzz_shortcodes", tinymce.plugins.vuzzShortcodeMce);
})();  