<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

function mmbr_setup() {
  $s_pkey = get_option(MMBR_OPTION_KEY);
  $retrieved_nonce = $_POST['mmbr_s_pkey'];

  if ( isset($_POST['_Submit']) ) {
    if( !wp_verify_nonce( $retrieved_nonce, 'mmbr_update_s_pkey_action') || !check_admin_referer('mmbr_update_s_pkey_action', 'mmbr_s_pkey' ) ){
      die ('Security check failed');
    } else {
      if ( current_user_can( 'manage_options') ){
    		if ( isset($_POST['mmbr_raw_s_pkey']) ) {
    			$s_pkey = sanitize_text_field($_POST['mmbr_raw_s_pkey']);
              update_option(MMBR_OPTION_KEY, $s_pkey);
          ?>
          <div style="padding: 1em; background: #3f901e; color: white;">
            <p style="margin: 0;">Your update was successful!</p>
          </div>
          <?php
        }
      } else {
        ?>
        <div style="padding: 1em; background: #A71E22; color: white;">
          <p style="margin: 0;">Sorry, only administrators can make this change.</p>
        </div>
        <?php
      }
    }
	}
?>

<img style="width: 100px;height: 100px;display: block;"  src="<?php echo MMBR_IMAGE_DIR ?>mmbr.png"/>
<p style="font-weight: bold;">MMBR helps you charge for access to content on your WordPress site.</p>
<p>To see a list of all that MMBR can do for you, visit our <a href="http://www.mmbr.io/features/" target="_blank">features page</a>.</p>
  <form action="" method="post" autocomplete="off">
    <div style="margin-top: 3em;">
      <h1>Configure MMBR</h1>
      <p>Create a paywall using the <a href="https://dashboard.mmbr.io" target="_blank">MMBR dashboard</a>. Follow the installation instructions to create a MMBR site and receive your site's public key.</p>
      <div style="width: 42em; background:white; padding: 1.5em 2em; position: relative;">
        <div style="display: inline-block;">
          <p>
						<span style="margin-right: 2em; font-weight: bold;">Activate MMBR</span>
            <br/>
						<span style="margin-right: 2em; color: #777">To create a MMBR site and receive your site's public key</span>
					</p>
        </div>
        <div style="width: 30%; display: inline-block; position: absolute; top: 48px;">
          <a href="https://dashboard.mmbr.io" target= "_blank" class="button-primary">Log in or sign up now</a>
        </div>
      </div>
      <div style="margin-top:2em;">
        <h3 style="margin-bottom:5px;">Your MMBR public key</h4>
        <p style="margin: 0 0 10px;">Once your site is created, copy the public key and paste it in box below.</p>
        <div style="background:white; width: 42em; padding: 1.5em 2em;">
          <p style="margin: 0 0 5px;">Public key</p>
          <div>
            <input name="mmbr_raw_s_pkey" style="width: 50%;" size="20" value="<?php echo esc_attr( $s_pkey ); ?>" />
            <?php wp_nonce_field( 'mmbr_update_s_pkey_action', 'mmbr_s_pkey' ) ?>
            <input type="submit" name="_Submit" value="Use this key" tabindex="4" class="button-primary" />
          </div>
        </div>
      </div>
    </div>
  </form>
<?php
}
?>
<?php
