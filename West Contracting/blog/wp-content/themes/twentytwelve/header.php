<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>


<meta name="description" content="Over the past 50 years, West Contracting has repaired thousands of parking lots throughout St. Louis and the surrounding area.  Let us provide an analysis of your asphalt pavement maintenance and repair needs for now and the future. We will work with you to get the job done on time and within your budget." />
<meta name="keywords" content=" saint louis asphalt maintenance,  saint louis asphalt pavement, west contracting, st. louis area, hot mix, contracting, asphalt repair, quality repairs" />
<script src="http://nbwest.com/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

function navs2_open()
{	navs2_canceltimer();
	navs2_close();
	ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

function navs2_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function navs2_timer()
{	closetimer = window.setTimeout(navs2_close(), timeout);}

function navs2_canceltimer()
{	if(closetimer)
	{	window.clearTimeout(closetimer);
		closetimer = null;}}

$(document).ready(function()
{	$('#navs2 > li').bind('mouseover', navs2_open);
	$('#navs2 > li').bind('mouseout',  navs2_timer);});

document.onclick = navs2_close();
</script>
<link href="http://nbwest.com/css/flexcrollstyles.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src="http://nbwest.com/js/flexcroll.js"></script>
<link href="http://nbwest.com/css/styles.css" rel="stylesheet" type="text/css" />
<link href="http://nbwest.com/css/styles_temp.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22548802-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body>
<div class="container">
<div id="topHdr1"></div>
<div id="topHdr2">
<div class="leftLogo"><img src="http://nbwest.com/images/logo_secondary.gif" width="121" height="51" alt="West Contracting" /></div>
<div class="rtLogo"><a href="tech_leader.html"><img src="http://nbwest.com/images/tech_leader_secondary.gif" width="104" height="63" alt="TECH LEADER" /></a></div>
</div>
  <div id="header">
<div id="nav">
<ul id="navs2">
	<li><a href="index.html">HOME</a></li>
	<li><a href="#">COMPANY OVERVIEW</a>
		<ul>
			<li><a href="../about.html">About Us</a></li>
			<li><a href="../history.html">History</a></li>
			<li><a href="../locations.html">Locations</a></li>
			<li><a href="../safety.html">Safety</a></li>
            <li><a href="../ms_locations.html">Areas We Serve</a></li>
            <li><a href="../openings.html">Careers/Current Openings</a></li>
			<li><a class="last" href="../contact.html">Contact Us</a></li>
		</ul>
	</li>
	<li><a  href="#">SERVICES</a>
		<ul>
			<li><a href="../serv_asphalt.html">Asphalt Paving</a></li>
			<li><a href="../new_construct.html">Asphalt for New Construction</a></li>
			<li><a href="../maintenance.html">Asphalt Maintenance</a></li>
			<li><a href="../resurfacing.html">Asphalt Resurfacing</a></li>
            <li><a href="../chipseal.html">Chip Seal Asphalt</a></li>
            <li><a href="../novachip.html">Ultra Thin Asphalt (Nova Chip)</a></li>
            <li><a href="../asphalt_mill.html">Asphalt Milling</a></li>
            <li><a href="../highways.html">Highways/Bridges</a></li>
			<li><a class="last" href="../site_dev.html">Site Development</a></li>
		</ul>
        </li>
        	<li><a class="onreg" href="#">UPM<span class="reg">&reg;</span> - POTHOLE REPAIRS</a>
		<ul>
			<li><a href="../unique.html">Unique Paving Materials</a></li>
			<li><a href="../upm_features.html">Features/Benefits</a></li>
            <li><a class="last" href="../upm_buy.html">Where To Buy UPM<span class="reg">&reg;</span></a></li>
		</ul>
        </li>
	<li><a href="#" >ASPHALT SALES</a>
		<ul>
			<li><a href="../asphalt_locations.html">Missouri Asphalt Plants</a></li>
			<li><a class="last" href="../quality.html">Our Commitment to Quality</a></li>
		</ul>
        </li>
	<li><a href="#">GO GREEN</a>
    <ul>		<li><a href="../recycle.html">Recycling</a></li>
            <li><a href="../environment.html">Preserving Our Environment</a></li>
			<li><a href="../porous.html">Porous Pavement</a></li>
            <li><a href="../opengraded.html">Open-Graded Pavement</a></li>
		</ul>    <li><a href="#" style="margin-top: -3.5px;">RESOURCES</a>		<ul>
			<li><a href="../news.html">In The News</a></li>
            <li><a href="../awards.html">Awards</a></li>
			<li><a href="../videos.html">Videos</a></li>
            <li><a href="../whitepapers.html">White Papers</a></li>
			<li><a href="../links.html">Links</a></li>
			<li><a class="last" href="../contact.html">Contact Us</a></li>
		</ul>
        </li>
        <li><a class="on" href="http://nbwest.com/blog" style="margin-top: -3.5px;">BLOG</a></li>
</ul>
</div>
<!-- end nav -->
    <!-- end .header --></div>
    <div class="bttm1"></div>
    <div class="bttm2"></div>
  <div id="contentb">
<div class="main">

<h1 class="fullPg">Blog</h1>
<h2 class="blogSubHead">What's on our mind today?</h2>
<div class="fullCol">
<div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>



