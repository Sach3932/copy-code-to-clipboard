<?php
/*
 *Plugin Name: Copy Code to Clipboard
 *Author: Sachin Londhe
 *Description: Copy Code to Clipboard.
 *Version: 1.1
 *Author: Sachin Londhe
 *Author URI: #
 *Text Domain:  copy-clipboard-code
 *License: GPLv3
 *License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

function code_copy_enqueue_script() { 

	//wp_enqueue_script( 'clipboard-js', plugin_dir_url( __FILE__ ) .'js/clipboard.min.js' ); 
	wp_enqueue_script('jquery');
	  wp_enqueue_script('clipboard-js', '/wp-includes/js/clipboard.min.js');

    wp_enqueue_script( 'copy_code_script', plugin_dir_url( __FILE__ ) . 'js/copy_code_script.js' );
	wp_enqueue_style( 'clipboard-css', plugin_dir_url( __FILE__ ) . 'css/clipboard-css.css' );
    wp_localize_script('copy_code_script', 'copyScript', array(
    'copy_text_label' => get_option('copy_text_label'),
	'copied_text_label' => get_option('copied_text_label'),
	'copy_text_label_safari' => get_option('copy_text_label_safari'),
	'copy_text_label_other_browser' => get_option('copy_text_label_other_browser'),
	'copy_button_background' => get_option('copy_button_background'),
	'copy_button_text_color' => get_option('copy_button_text_color'),	
	));	
}
add_action('wp_enqueue_scripts', 'code_copy_enqueue_script');

//Added 13-11-2019
// Admin Enqueque Scripts
function code_copy_admin_enqueue_script() { 
	if( is_admin() ) { 
	
		wp_enqueue_style( 'clipboard-css', plugin_dir_url( __FILE__ ) . 'css/clipboard-css.css' ); 
	// Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'color-script', plugins_url( 'js/color-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
	}	
}
add_action( 'admin_enqueue_scripts', 'code_copy_admin_enqueue_script' );


//Adding Admin Page For Settings
function copy_code_to_clipboard_Menu()
	{

		/* Adding menus */
		add_menu_page(__('Copy Code To Clipboard'),'Copy Code To Clipboard', 'manage_options','copy-code-to-clipboard', 'copy_code_to_clipboard', plugins_url( 'copy-code-to-clipboard/images/copy.svg' ));
		
		//call register settings function
		add_action( 'admin_init', 'register_my_copy_code_to_clipboard_plugin_settings' );

	}


add_action('admin_menu', 'copy_code_to_clipboard_Menu');

function register_my_copy_code_to_clipboard_plugin_settings() {
	//register our settings
	register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_text_label' );
	register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copied_text_label' );
	register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_text_label_safari' );
	register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_text_label_other_browser' );
	register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_button_background' );
	register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_button_text_color' );
}

function copy_code_to_clipboard(){?>
<div class="wrap">
		 <div id="icon-options-general" class="icon32"></div>
		 <h1>Copy Code To Clipboard</h1>
		 <form method="post" action="options.php">
<?php settings_fields( 'my-copy-code-to-clipboard-plugin-settings-group' ); ?>
<?php do_settings_sections( 'my-copy-code-to-clipboard-plugin-settings-group' ); ?>
<table class="form-table">
<tr valign="top">
<th scope="row">Copy Text Label</th>
<td><input type="text" name="copy_text_label" value="<?php echo esc_attr( get_option('copy_text_label') ); ?>" /></td>
</tr>
 
<tr valign="top">
<th scope="row">Copied Text Label</th>
<td><input type="text" name="copied_text_label" value="<?php echo esc_attr( get_option('copied_text_label') ); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Copy Text Label For Safari/Ipad/Iphone</th>
<td><input type="text" name="copy_text_label_safari" value="<?php echo esc_attr( get_option('copy_text_label_safari') ); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Copy Text Label For Other Browser</th>
<td><input type="text" name="copy_text_label_other_browser" value="<?php echo esc_attr( get_option('copy_text_label_other_browser') ); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Button Background Color</th>
<td><input type="text" class="color-field" name="copy_button_background" value="<?php echo esc_attr( get_option('copy_button_background') ); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Button Text Color</th>
<td><input type="text" class="color-field" name="copy_button_text_color" value="<?php echo esc_attr( get_option('copy_button_text_color') ); ?>" /></td>
</tr>
</table>

<?php submit_button(); ?>

</form>

 </div>
	
<?php }

//Deactivation Hook
// this code runs during plugin deactivation
function deactivate_copy_code_to_clipboard(){
	
//Delete Option
   delete_option( 'copy_text_label' );
   delete_option( 'copied_text_label' );
   delete_option( 'copy_text_label_safari' );
   delete_option( 'copy_text_label_other_browser' );
   delete_option( 'copy_button_background' );
   delete_option( 'copy_button_text_color' );
}

register_deactivation_hook(__FILE__, 'deactivate_copy_code_to_clipboard');