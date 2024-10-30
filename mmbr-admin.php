<?php
if ( !defined( 'ABSPATH' ) ) {
		exit;
}

require_once dirname( __FILE__ ) . '/mmbr-install.php';
require_once dirname( __FILE__ ) . '/mmbr-form.php';

add_action("admin_menu", 'mmbr_admin_pages');

function mmbr_admin_pages() {
	if(current_user_can( 'manage_options')) {
		add_menu_page( 'MMBR', 'MMBR', 'manage_options', 'mmbr.php', 'mmbr_setup', MMBR_FAVICON );
	}
}
