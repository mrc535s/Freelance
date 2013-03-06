themeblvdShortcodeAtts={
	attributes:[
			{
				label:"File",
				id:"file",
				help:"Enter the full url to the audio file like this:<br/>http://yoursite.com/uploads/song.mp3"
			},
			{
				label:"Auto Start",
				id:"autostart",
				help:"This determines whether the audio file starts playing automatically when the page loads or not.", 
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false'
			},
			{
				label:"Player Skin Color",
				id:"color",
				help:"Enter a color hex value that you'd like to skin your Audio Player with (ex: 000000)."
			},
			{
				label:"Player Width",
				id:"width",
				help:"This is optional. By default, the audio player will be '290' wide if you leave this blank. '290' is the optimum width to get the best looking resolution from the audio player."
			}
			
	],
	defaultContent:"",
	shortcode:"audio"
};
