themeblvdShortcodeAtts={
	attributes:[
		{
			label:"Slideshow to pull from where?",
			id:"category",
			help:"Enter the slug of the slideshow you'd like to pull slides from (ex: 'your-slideshow'). You can find the slug of the slideshow by going to Slides > Slideshows, and finding your slideshow. Leave this option blank to pull <em>all</em> slides."
		},
		{
			label:"Width",
			id:"width",
			help:"Enter the width of the slideshow (ex: '560')."
		},
		{
			label:"Height",
			id:"height",
			help:"Enter the height of the slideshow (ex: '250')."
		},
		{
			label:"Transition Effect",
			id:"effect",
			help:"Choose how you'd like your slideshow to transition from slide to slide. The most popular choices are 'fade' and 'scrollHorz'.", 
			controlType:"select-control", 
			selectValues:['fade', 'blindX', 'blindY', 'blindZ', 'cover', 'curtainX', 'curtainY', 'fadeZoom', 'growX', 'growY', 'scrollUp', 'scrollDown', 'scrollLeft', 'scrollRight', 'scrollHorz', 'scrollVert', 'shuffle', 'slideX', 'slideY', 'toss', 'turnUp', 'turnDown', 'turnLeft', 'turnRight', 'uncover', 'wipe', 'zoom', 'none']
		},
		{
			label:"Time Between Slides",
			id:"speed",
			help:"Enter the amount of time in seconds between slide transitions (ex: '5')."
		},
		{
			label:"Description Overlay Color",
			id:"color",
			help:"Enter the hex color code you'd like use for any descriptions inserted over your image slides (ex: '000000')."
		}
			
	],
	defaultContent:"",
	shortcode:"slideshow"
};



