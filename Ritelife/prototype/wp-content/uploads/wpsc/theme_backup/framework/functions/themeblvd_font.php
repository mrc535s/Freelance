<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Fonts
 *
 * This function displays selected fonts CSS
 * for the theme in the <head> of header.php.
 *
 * @author  Jason Bobich
 *
 */

//Font stack list
$font_stacks = array(
    "arial" => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
    "baskerville" => 'Baskerville, "Times New Roman", Times, serif',
    "cambria" => 'Cambria, Georgia, Times, "Times New Roman", serif',
    "century-gothic" => '"Century Gothic", "Apple Gothic", sans-serif',
    "consolas" => 'Consolas, "Lucida Console", Monaco, monospace',
    "copperplate-light" => '"Copperplate Light", "Copperplate Gothic Light", serif',
    "courier-new" => '"Courier New", Courier, monospace',
    "franklin" => '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif',
    "futura" => 'Futura, "Century Gothic", AppleGothic, sans-serif',
    "garamond" => 'Garamond, "Hoefler Text", Times New Roman, Times, serif',
    "geneva" => 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif',
    "georgia" => 'Georgia, Palatino," Palatino Linotype", Times, "Times New Roman", serif',
    "gill-sans" => '"Gill Sans", Calibri, "Trebuchet MS", sans-serif',
    "helvetica" => '"Helvetica Neue", Arial, Helvetica, sans-serif',
    "impact" => 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif',
    "lucida" => '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif',
    "palatino" => 'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif',
    "tahoma" => 'Tahoma, Geneva, Verdana',
    "times" => 'Times, "Times New Roman", Georgia, serif',
    "trebuchet" => '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif',
    "verdana" => 'Verdana, Geneva, Tahoma, sans-serif'
);


function themeblvd_font($headers, $body, $size){

	//Font stack list
	global $font_stacks;
	
    //Body font
    $body_font = $font_stacks[$body];

    //Header font
    if($headers != 'none') {

        //Format font value
        $header_font_value = $headers;

        //Format font name
        $header_font_family = str_replace('+', ' ', $headers);
        $header_font_family = explode(':', $header_font_family);
        $header_font_family = explode('?', $header_font_family[0]);
        $header_font_family = $header_font_family[0];
        
    }

    ?>

    <?php if($headers != 'none') : ?>
    <link href="http://fonts.googleapis.com/css?family=<?php echo $header_font_value; ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    
    <style type="text/css">
    body { font-family: <?php echo $body_font; ?>; font-size: <?php echo $size; ?>; }
    <?php if($headers != 'none') : ?>
    h1, h2, h3, h4, h5, h6 { font-family: '<?php echo $header_font_family; ?>'; }
    <?php endif; ?>
    </style>
    
<?php
##################################################################
} # end themeblvd_font function
##################################################################
?>