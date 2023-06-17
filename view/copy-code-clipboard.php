<div class="wrap">
  <div id="icon-options-general" class="icon32"></div>
  <h1>Copy Code To Clipboard</h1>
  <form method="post" action="options.php"> <?php settings_fields( 'my-copy-code-to-clipboard-plugin-settings-group' ); ?> <?php do_settings_sections( 'my-copy-code-to-clipboard-plugin-settings-group' ); ?> <table class="form-table">
      <tr valign="top">
        <th scope="row">Copy Text Label</th>
        <td>
          <input type="text" name="copy_text_label" value="<?php echo esc_attr( get_option('copy_text_label') ); ?>" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Copied Text Label</th>
        <td>
          <input type="text" name="copied_text_label" value="<?php echo esc_attr( get_option('copied_text_label') ); ?>" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Copy Text Label For Safari/Ipad/Iphone</th>
        <td>
          <input type="text" name="copy_text_label_safari" value="<?php echo esc_attr( get_option('copy_text_label_safari') ); ?>" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Copy Text Label For Other Browser</th>
        <td>
          <input type="text" name="copy_text_label_other_browser" value="<?php echo esc_attr( get_option('copy_text_label_other_browser') ); ?>" />
        </td>
      </tr>
	  
	  <tr valign="top">
        <th scope="row">Copy Code Block Background</th>
        <td>
          <input type="text" class="color-field" name="copy_code_block_background" value="<?php echo esc_attr( get_option('copy_code_block_background') ); ?>" />
        </td>
      </tr>
	  
	  <tr valign="top">
        <th scope="row">Copy Code Block Text Color</th>
        <td>
          <input type="text" class="color-field" name="copy_code_block_text_color" value="<?php echo esc_attr( get_option('copy_code_block_text_color') ); ?>" />
        </td>
      </tr>
	  
      <tr valign="top">
        <th scope="row">Button Background Color</th>
        <td>
          <input type="text" class="color-field" name="copy_button_background" value="<?php echo esc_attr( get_option('copy_button_background') ); ?>" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Button Text Color</th>
        <td>
          <input type="text" class="color-field" name="copy_button_text_color" value="<?php echo esc_attr( get_option('copy_button_text_color') ); ?>" />
        </td>
      </tr>
    </table> <?php submit_button(); ?> </form>
</div>