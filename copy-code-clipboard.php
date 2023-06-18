<?php
/*
 *Plugin Name: Copy Code to Clipboard
 *Author: Sachin Londhe
 *Description: Copy Code to Clipboard.You are free to customize the color combinations as per your choice to make it beautiful and clean.
 *Version: 1.2
 *Author: Sachin Londhe
 *Author URI: https://profiles.wordpress.org/sach3932
 *Text Domain:  copy-clipboard-code
 *License: GPLv3
 *License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! class_exists( 'Copy_Code_To_Clipboard' ) ) :

	class Copy_Code_To_Clipboard {
		function __construct(){
			add_action('wp_enqueue_scripts', array($this,'code_copy_enqueue_script'));
			add_action( 'admin_enqueue_scripts', array($this,'code_copy_admin_enqueue_script' ));
			add_action('admin_menu', array($this,'copy_code_to_clipboard_Menu'));
			register_deactivation_hook(__FILE__, array($this,'deactivate_copy_code_to_clipboard'));
			//call register settings function
			add_action( 'admin_init', array($this,'register_my_copy_code_to_clipboard_plugin_settings' ));
		}
		
		function code_copy_enqueue_script() { 

			wp_enqueue_script('jquery');
			wp_enqueue_script('clipboard-js', '/wp-includes/js/clipboard.min.js');
			wp_enqueue_script( 'copy_code_script', plugin_dir_url( __FILE__ ) . 'js/copy_code_script.js' );
			wp_enqueue_style( 'clipboard-css', plugin_dir_url( __FILE__ ) . 'css/clipboard-css.css' );
			wp_localize_script('copy_code_script', 'copyScript', array(
			'copy_text_label' => get_option('copy_text_label'),
			'copied_text_label' => get_option('copied_text_label'),
			'copy_text_label_safari' => get_option('copy_text_label_safari'),
			'copy_text_label_other_browser' => get_option('copy_text_label_other_browser'),
			'copy_code_block_background' => get_option('copy_code_block_background'),
			'copy_code_block_text_color' => get_option('copy_code_block_text_color'),
			'copy_button_background' => get_option('copy_button_background'),
			'copy_button_text_color' => get_option('copy_button_text_color'),	
			));
			
		}
		
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
		
		//Adding Admin Page For Settings
		function copy_code_to_clipboard_Menu()
			{

				/* Adding menus */
				add_menu_page(__('Copy Code To Clipboard'),'Copy Code To Clipboard', 'manage_options','copy-code-to-clipboard', array ($this,'copy_code_to_clipboard'), plugins_url( 'copy-code-to-clipboard/images/copy.svg' ));
				
				

		}
		
		function register_my_copy_code_to_clipboard_plugin_settings() {
			//register our settings
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_text_label' );
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copied_text_label' );
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_text_label_safari' );
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_text_label_other_browser' );
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_code_block_background' );
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_code_block_text_color' );
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_button_background' );
			register_setting( 'my-copy-code-to-clipboard-plugin-settings-group', 'copy_button_text_color' );
		}

		function copy_code_to_clipboard(){
			include_once 'view/copy-code-clipboard.php';
		}
		
		//Deactivation Hook
		// this code runs during plugin deactivation
		function deactivate_copy_code_to_clipboard(){
			
		   //Delete Option
		   delete_option( 'copy_text_label' );
		   delete_option( 'copied_text_label' );
		   delete_option( 'copy_text_label_safari' );
		   delete_option( 'copy_text_label_other_browser' );
		   delete_option( 'copy_code_block_background' );
		   delete_option( 'copy_code_block_text_color' );
		   delete_option( 'copy_button_background' );
		   delete_option( 'copy_button_text_color' );
		}
		
	}
	
	new Copy_Code_To_Clipboard();


endif;