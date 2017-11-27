<?php
/**
 * Place <var>printLikeButton()</var> in your theme's image.php file where you want it to appear.
 *		Something like:
 *
 *		<pre><?php if (function_exists('printLikeButton')) { ?></pre>
 *		<pre><?php printLikeButton(); ?></div></pre>
 *		<pre><?php  } ?></pre>
 *
 * To customise go to the admin area and select option/plugin.
 */

$plugin_is_filter = 5 | THEME_PLUGIN;
$plugin_description = gettext("Adds Facebook 'Like' button");
$plugin_author = 'Jim Brown';
$plugin_version = '1.0';
$option_interface = "Like_Options";

zp_register_filter('theme_body_open', 'printLikeButtonJS');

function printLikeButtonJS() {
  ?>
	<div id="fb-root"></div>
	<script type="text/javascript">
    /* Facebook Like Button */
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
  	}
    (document, 'script', 'facebook-jssdk'));
  </script>
  <?php
}

function printLikeButton() {
	$data_width = getOption('fbwidth');
	$data_show_faces = getOption('fbfaces');
	$data_font = getOption('fbfont');
	$data_layout = getOption('fblayout');
	$data_colorscheme = getOption('fbcolorscheme');
	$data_action = getOption('fbaction');

	echo '<div class="fb-like" data-href="' . html_encode(getMainSiteURL()) . html_encode(getImageURL()) . '" ';
	echo 'data-send="false" data-width="' . $data_width . '" data-show-faces="' . $data_show_faces . '" data-font="' . $data_font . '" ';
	echo 'data-layout="' . $data_layout . '" data-colorscheme="' . $data_colorscheme . '" data-action="' . $data_action . '">';
	echo "</div>";
}

/**
 * Plugin option handling class
 *
 */
class Like_Options {

	function Like_Options() {
		setOptionDefault('fbwidth', 450);
		setOptionDefault('fbfaces', false);
		setOptionDefault('fbfont', 'arial');
		setOptionDefault('fblayout', 'standard');
		setOptionDefault('fbcolorscheme', 'light');
		setOptionDefault('fbaction', 'like');
		}
	
	function getOptionsSupported() {
		return array (gettext('Width') => array('key' => 'fbwidth',
                          'type' => OPTION_TYPE_TEXTBOX,
  												'order'=>1,
  												'desc' => gettext('Enter width in Pixels.')),
        					gettext('Profile Photo') => array('key' => 'fbfaces',
                          'type' => OPTION_TYPE_CHECKBOX,
  												'order'=>2,
  												'desc' => gettext('Select to show profile photo for Standard Layout only.')),
	         				gettext('Display Font') => array('key' => 'fbfont',
                          'type' => OPTION_TYPE_SELECTOR,
  												'order' =>6,
  												'selections' => array(gettext('Arial') => 'arial', 
  																		          gettext('Tahoma') => 'tahoma', 
            																		gettext('Verdana') => 'verdana'),
  												'desc' => gettext('Select Display Font.')),
        					gettext('Layout Style') => array('key' => 'fblayout',
                          'type' => OPTION_TYPE_SELECTOR,
  												'order' =>3,
  												'selections' => array(gettext('Standard') => 'standard', 
            																		gettext('Box Count') => 'box_count', 
            																		gettext('Button Count') => 'button_count'), 
  												'desc' => gettext('Select Layout Style.')),						
        					gettext('Display Button Text') => array('key' => 'fbaction',
                          'type' => OPTION_TYPE_SELECTOR,
  												'order' =>4,
  												'selections' => array(gettext('Like') => 'like', 
            																		gettext('Recommend') => 'recommend'), 
  												'desc' => gettext('Select text to display on the button.')),							
        					gettext('Colour Scheme') => array('key' => 'fbcolorscheme',
                          'type' => OPTION_TYPE_SELECTOR,
  												'order' =>5,
  												'selections' => array(gettext('Light') => 'light', 
            																		gettext('Dark') => 'dark'), 
  												'desc' => gettext('Select Colour Scheme.')));					
	}
}
?>