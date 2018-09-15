<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields( 'avionte-settings-group' ); ?>
        <?php do_settings_sections( 'avionte-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">RSS URL</th>
                <td><input type="text" name="avionte_url_option" value="<?php echo esc_attr( get_option('avionte_url_option') ); ?>" /></td>
            </tr>
            <tr valign="top">
            <th scope="row"></th>
                <td><?php submit_button(); ?></td>
            </tr>

        </table>
    </form>
</div>