<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

function mmbr_activate() {
  add_option(MMBR_OPTION_KEY, '');
}

function mmbr_deactivate() {
  delete_option(MMBR_OPTION_KEY);
}
