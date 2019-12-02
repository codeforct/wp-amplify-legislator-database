<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://codeforconnecticut.org
 * @since      1.0.0
 *
 * @package    Amplify_Legislators_Database
 * @subpackage Amplify_Legislators_Database/admin/partials
 */

  $form_url   = esc_url( admin_url( 'admin-post.php' ) );
  $form_nonce = wp_create_nonce( 'amplify_process_database_form_nonce' );
?>

<h1>Amplify Legislators Database</h1>
<form action="<?php echo $form_url; ?>" method="POST">
  <input type="hidden" name="action" value="amplify_process_database_form">
  <input type="hidden" name="amplify_process_database_form_nonce" value="<?php echo $form_nonce; ?>" />
  <input type="submit" name="submit" id="submit" class="button button-primary" value="Submit">
</form>
