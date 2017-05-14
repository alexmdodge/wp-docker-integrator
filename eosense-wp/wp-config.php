<?php
/** Enable W3 Total Cache */
define('WP_CACHE', false); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'mysql');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'U]CFm?tNrt]qYz_NkH^LQ>SgOtBI<NVB;@MmGpDt@+c{|p<^MKy(@}au<QxdnEF$wq&O@xbx)-$nO))I(Nz?CnczQOla$@]jBMfKeh!qiOaN?<HzTphRA]P[Flk[-JAL');
define('SECURE_AUTH_KEY', '}KAMrClp?mV>(g_lx^}<b&V=apvPv*W*@GtX|_|A%%NYE/axc}[fh^vx<ty>|EX^G+;TnPvf/s+i;u]}cHc%i=aS=jcLbP=DGlitybS_wB>p|!-RDZ^+SF-$;PjyyC_f');
define('LOGGED_IN_KEY', 'F{?=bP;Y*)z<QDmsn<rDb!Xs@GbOD>(O_bX@/Uhg_ZUzh=/=]hbSPk/c+es^/oy)c-?+KGb(kDnx+(/cadW>}-u*UJWCmp)$H[wcBUqc%SO[yDzpJkLOVwK?eXTyIDQ+');
define('NONCE_KEY', 'bZIagkU{rUnL=i}-gRM^{l+|$!D>pXDTjEuu^T*FYTwFR[ff{De^=}xyn^cA/Vq]YKSXfiC>Pje@h&UaZRf/SJhgwti&IYzL)*|Qfqg&QCR*b!OAyidq(sM*sXFHPojx');
define('AUTH_SALT', 'UJB*Jn@/xfR/SaAM@h!Ia)Gx+|hdnpdoDkO?R-u]!]w{bp-BGfR(@|TR>yNLm_QY(!&I*$ntbzszvTgyg%EW|dLPiPH+/pzYriF<tI+)xTDsDm*bghYmlm{B*HMpP{hY');
define('SECURE_AUTH_SALT', 'S]J=+|url?[FgP{C^e{SQAQZ>GD@j^to&Hd/nI?D{KE^FF<nxqhpYqCzGbGONfS|y]D_bihGV<*WWuu<twCQUIlvBJqSUJiwL{AyyjgYpNHiEqBX_YqzAw][WbJ^IVbq');
define('LOGGED_IN_SALT', 'BT{X=sHHGV^cm$en*W|=RicsUdmT(yqlnSn}S@S(y!MZ=$F!BDZnC[F)ILz|[BMgUAzFYDHyvIG--pBfody;vNgU@Wb>f}%*];vyQ]dJ]TfV}pzy}ST&OwQ=s;|-*^ul');
define('NONCE_SALT', '&l/LUkmg$V?T-Fx&JKH*_agdmYy<qv)B)PL/|Sl/[|/|d;-jxLgTx==GXSPT(-@xTj}@*FdV{tGESd}ZK<Z![VKhkICwWRH)lblExc!m/Kn*i>>o!oDqjL(W{C]Ps]+o');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_clvq_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_SITEURL', 'http://localhost:8080/' );  
define( 'WP_HOME',    'http://localhost:8080/' );