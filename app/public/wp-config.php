<?php
# Database Configuration
define( 'DB_NAME', 'local' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'root' );
define( 'DB_HOST', 'localhost' );
define( 'DB_HOST_SLAVE', '127.0.0.1:8889' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'stDDlU8-g6GSKJlD40q9bqoDWZgdM5njuMxX~ni8erRzMmT~S,J7$),qJoSBuY+&');
define('SECURE_AUTH_KEY',  'yz3T*(6h?O^O(_TW5(Zjee*MH,UV_6P,cqAjCs5S+Zea&sz?_Tox,Cac&7FWRz.2');
define('LOGGED_IN_KEY',    'ryN^46%+k5X09XtiOvp2.aQ#~5YJtNdDImBIEU-@1Kr?Jz6UFqyS01.FoT9oRwP?');
define('NONCE_KEY',        '+d#D6l-?~#ieA9mnUjpQO=svlFdh.QCv(dlZgn38uZtDGl2T!UApVr8kS5F1Evir');
define('AUTH_SALT',        'sVQLfIh3DqFp9LHh?lq%Zkwy6#fB0voXVsh6pvSYG&6&z@(X~~7ylnyiZbW,IT~r');
define('SECURE_AUTH_SALT', '!akb_Ro6h=VW(gE(6GZu3+@w4,Ef.Fzu,%2#*$cm(z(^9O8#rZiuubnulp$2w?K7');
define('LOGGED_IN_SALT',   'C?c%9dNOc7J*ZWPTGM==__^RjDDHFMjidnHhI)0n$B!nui%%vX-V4yoCl)po4YLk');
define('NONCE_SALT',       'muI~%!nxQH7+h_iBhMNloZfs$FQtORrzyw(99&5*YsG)smp!(SQ~uPz3vqj1?L%O');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'nzddevtest7' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', '9ae1f329e720132aa6858fb144c75aeb52eac0be' );

define( 'WPE_CLUSTER_ID', '211430' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_SFTP_ENDPOINT', '35.201.12.221' );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'nzddevtest7.wpengine.com', 1 => 'nzddevtest7.wpenginepowered.com', );

$wpe_varnish_servers=array ( 0 => '127.0.0.1', );

$wpe_special_ips=array ( 0 => '35.189.50.55', 1 => 'pod-211430-utility.pod-211430.svc.cluster.local', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');
