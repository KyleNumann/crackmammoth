<?php

if($_GET['d']){
  // if direct download, we send the full url
  $d = $_GET['d'];

}
if($_GET['id']){
  // if gated download, we only send the attachment id, because we are sneaky
  $id = $_GET['id'];

  // check to see if the WP environment is loaded or not
  if ( !defined('ABSPATH') ) {
    // if not, set it up
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
  }

  $d = wp_get_attachment_url( $id );

}

// needs to be a relative url
$file = '../../../'. substr($d, strpos($d, '/uploads'));


// un-comment this code to re-enable cookie verification
// $allow = $_COOKIE['allow_download'] == 1 && file_exists($file);
$allow = file_exists($file);

if ($allow) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
} else {
    echo 'Sorry. It seems you do not have permission to download that file, or the file does not exist.';
    echo '<br><br>';
    echo '<a href="http://www.goldenspiralmarketing.com/">Golden Spiral Marketing Home</a>';
}

exit;

?>
