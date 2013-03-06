themeblvdShortcodeAtts={
	attributes:[
			{
				label:"File",
				id:"file",
				help:"Enter the url to the video file.<h4>Self-Hosted Video</h4><p>Enter the full url to the video like this:<br />http://yoursite.com/uploads/video.<strong>flv</strong><br/>http://yoursite.com/uploads/video.<strong>f4v</strong><br />http://yoursite.com/uploads/video.<strong>mp4</strong></p><h4>Vimeo Video</h4><p>Enter the full url to the video page like this:<br />http://vimeo.com/1034172</p><h4>YouTube Video</h4><p>Enter the full url to the video page like this:<br />http://youtube.com/watch?v=Uv7SUncOAAQ</p>"
			},
			{
				label:"Width",
				id:"width",
				help:"Enter the width of your video."
			},
			{
				label:"Height",
				id:"height",
				help:"Enter the height of your video."
			},
			{
				label:"Auto Start",
				id:"autostart",
				help:"This determines whether the video starts playing automatically when the page loads or not.", 
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false'
			},
			{
				label:"Starting Image",
				id:"image",
				help:"Enter the full URL to the image you'd like to show before the video starts playing. Ignore this option if you're using a video from YouTube or Vimeo."
			},
			{
				label:"Player Skin Color",
				id:"color",
				help:"Enter a color hex value that you'd like to skin your Video Player with (ex: 000000). Ignore this option if you're using a video from YouTube or Vimeo."
			},
			{
				label:"Logo Image",
				id:"logo",
				help:"Enter the full URL to your logo that you'd like to appear in the bottom right corner of your video. This is completely optional. Ignore this option if you're using a video from YouTube or Vimeo."
			},
			{
				label:"Logo Image Width",
				id:"logo_width",
				help:"This is completely optional. Ignore this option if you're using a video from YouTube or Vimeo."
			},
			{
				label:"Logo Image Height",
				id:"logo_height",
				help:"This is completely optional. Ignore this option if you're using a video from YouTube or Vimeo."
			}
	],
	defaultContent:"",
	shortcode:"video"
};
