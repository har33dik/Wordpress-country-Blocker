<?php
/*
Plugin Name: Country Blocker Plugin
Plugin URI: http://websitefuse.com
Description: Block country users from accessing the website.
Version: 1.0
Author: Hardik Gawari
Author URI: http://websitefuse.com
*/



require_once(dirname(__FILE__).'/includes/websitefuse_country_blocker_install.php');
register_activation_hook( __FILE__, 'websitefuse_country_blocker_install' );
register_deactivation_hook(__FILE__, 'websitefuse_country_blocker_uninstall' );


if (!defined('MYPLUGIN_PLUGIN_NAME'))
    define('MYPLUGIN_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('MYPLUGIN_PLUGIN_DIR'))
    define('MYPLUGIN_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MYPLUGIN_PLUGIN_NAME);

if (!defined('MYPLUGIN_PLUGIN_URL'))
    define('MYPLUGIN_PLUGIN_URL', WP_PLUGIN_URL . '/' . MYPLUGIN_PLUGIN_NAME);

/************************
Admin Section
************************/
if ( is_admin() ) {
	require_once(MYPLUGIN_PLUGIN_DIR.'/admin.php');
	add_action('admin_menu','websitefuse_add_admin_menu');
	add_action('admin_head','websitefuse_assets');
}





/************************
Admin Section End
************************/




/************************
User Section 
************************/

$websitefuse_redirect_url="http://www.websitefuse.com/secure";

require_once('geoip/src/geoip.inc');
require_once('geoip/src/geoipcity.inc');
require_once('geoip/src/geoipregionvars.php');



add_action('wp','websitefuse_country_blocker');



/////Check weather the user should be given access or not
function websitefuse_country_blocker(){

	global $wpdb;
	$ip= $_SERVER['REMOTE_ADDR'];
	$ip='3.3.3.3';

	///Handling IPv4 
	if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
	{
		list($o1, $o2, $o3, $o4) = explode(".", $ip);

				$ip_num_user = ( 16777216 * $o1 )
				        + (    65536 * $o2 )
				        + (      256 * $o3 )
				        +              $o4;

		$ipv4_row = $wpdb->get_results( 'SELECT * FROM websitefuse_ipv4 where ip_num='.$ip_num_user);

		if(!empty($ipv4_row)){
			foreach ($ipv4_row as $ipv4) {
				if($ipv4->allow==0){
					$webistefuse_access='block';
					header("Location: http://www.websitefuse.com/secure");
					exit(0);
				}elseif($ipv4->allow==1){
					$webistefuse_access='allow';
				}
			}
		}

		if(!isset($webistefuse_access)){
			$gi = geoip_open(MYPLUGIN_PLUGIN_DIR."/geoip/GeoIP.dat", GEOIP_STANDARD);
			$websitefuse_user_from=geoip_country_code_by_addr($gi, $ip);
			$websitefuse_block_country=get_option('websitefuse_block_country',array());
			if(in_array($websitefuse_user_from, $websitefuse_block_country)){
				header("Location: http://www.websitefuse.com/secure");
				exit(0);
			}
		}


	}/////Handling  IPv6
	elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){

		$gi = geoip_open(MYPLUGIN_PLUGIN_DIR."/geoip/GeoIPv6.dat", GEOIP_STANDARD);
		
		$websitefuse_user_from=geoip_country_code_by_addr_v6($gi, $ip);
		
		$websitefuse_block_country=get_option('websitefuse_block_country',array());
		if(in_array($websitefuse_user_from, $websitefuse_block_country)){
			header('Location: http://www.websitefuse.com/secure');
			exit(0);
		}
	}
}

?>
