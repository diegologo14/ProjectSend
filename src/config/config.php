<?php
/**
 * ProjectSend system constants
 *
 * This file includes the most basic system options that cannot be
 * changed through the web interface, such as the version number,
 * php directives and the user and password length values.
 *
 * @package ProjectSend
 * @subpackage Core
 */
session_start();

/**
 * Current version.
 * Updated only when releasing a new downloadable complete version.
 */
define('CURRENT_VERSION', '1.0.0');

/**
 * Used to check if the database needs updating.
 * Update version format: {year}{month}{day}{id} where ID helps do more than 1 update per day
*/
define('DATABASE_VERSION', '201807051');

/**
 * Required software versions
 */
define('REQUIRED_VERSION_PHP', '5.6');
define('REQUIRED_VERSION_MYSQL', '5.0');

/**
 * Fix for including external files when on HTTPS.
 * Contribution by Scott Wright on
 * http://code.google.com/p/clients-oriented-ftp/issues/detail?id=230
 */
define('PROTOCOL', empty($_SERVER['HTTPS'])? 'http' : 'https');

/**
 * DEBUG constant effects:
 * - Changes the error_reporting php value
 * - Enables the PDOEX extension (on the database class) to count queries
 */
define('DEBUG', true);

/**
 * IS_DEV is set to true during development to show a sitewide remainder
 * of the app unreleased status.
 */
define('IS_DEV', true);

/**
 * This constant holds the current default charset
 */
define('CHARSET', 'UTF-8');

/**
 * Turn off reporting of PHP errors, warnings and notices.
 * On a development environment, it should be set to E_ALL for
 * complete debugging.
 *
 * @link http://www.php.net/manual/en/function.error-reporting.php
 */
if ( DEBUG === true ) {
	error_reporting(E_ALL | E_STRICT);
}
else {
	error_reporting(0);
}

define('GLOBAL_TIME_LIMIT', 240*60);
define('UPLOAD_TIME_LIMIT', 120*60);
@set_time_limit(GLOBAL_TIME_LIMIT);

/**
 * Define the RSS url to use on the home news list.
 */
define('NEWS_FEED_URI','https://www.projectsend.org/feed/');
define('NEWS_JSON_URI','https://www.projectsend.org/serve/news.php');

/**
 * Define the Feed from where to take the latest version
 * number.
 */
define('UPDATES_FEED_URI','https://projectsend.org/updates/versions.xml');
define('UPDATES_JSON_URI', 'https://projectsend.org/serve/versions.php');

/** Directories */
define('CORE_LANG_DIR', ROOT_DIR . DS . 'lang');
define('CLASSES_DIR', CORE_DIR . DS . 'classes');
define('ADMIN_VIEWS_DIR', CORE_DIR . DS . 'View');
define('FORMS_DIR', ADMIN_VIEWS_DIR . DS . 'forms');
define('AUTOLOAD_DIR', CORE_DIR . DS . 'autoload');
define('INCLUDES_DIR', CORE_DIR . DS . 'includes');

/**
 * Check if the personal configuration file exists
 * Otherwise will start a configuration page
 *
 * @see sys.config.sample.php
 */
define('CONFIG_DIR', ROOT_DIR . DS . 'config');
define('CONFIG_FILE', CONFIG_DIR . DS . 'config.php');
define('CONFIG_SAMPLE', ROOT_DIR . DS . 'config.sample.php');

/* Load personal configuration file */
if ( file_exists( CONFIG_FILE ) ) {
	require_once CONFIG_FILE;
}

/**
 * Database connection driver
 */
if (!defined('DB_DRIVER')) {
	define('DB_DRIVER', 'mysql');
}

/**
 * Define the tables names
 */
if (!defined('TABLES_PREFIX')) {
	define('TABLES_PREFIX', 'tbl_');
}

$all_system_tables = array(
    'files',
    'files_relations',
    'downloads',
    'notifications',
    'options',
    'users',
    'groups',
    'members',
    'members_requests',
    'folders',
    'categories',
    'categories_relations',
    'actions_log',
    'password_reset',
);
foreach ( $all_system_tables as $table ) {
    $const = strtoupper( 'table_' . $table );
    define( $const, TABLES_PREFIX . $table );
}

/**
 * This values affect both validation methods (client and server side)
 * and also the maxlength value of the form fields.
 */
define('MIN_USER_CHARS', 5);
define('MAX_USER_CHARS', 60);
define('MIN_PASS_CHARS', 5);
define('MAX_PASS_CHARS', 60);

define('MIN_GENERATE_PASS_CHARS', 10);
define('MAX_GENERATE_PASS_CHARS', 20);
/*
 * Cookie expiration time (in seconds).
 * Set by default to 30 days (60*60*24*30).
 */
define('COOKIE_EXP_TIME', 60*60*24*30);

/**
 * Time (in seconds) after which the session becomes invalid.
 * Default is disabled and time is set to a huge value (1 month)
 * Case uses must be analyzed before enabling this function
 */
define('SESSION_TIMEOUT_EXPIRE', true);
$session_expire_time = 31*24*60*60; // 31 days * 24 hours * 60 minutes * 60 seconds
define('SESSION_EXPIRE_TIME', $session_expire_time);

/**
 * Define the system name, and the information that will be used
 * on the footer blocks.
 *
 */
define('SYSTEM_NAME','ProjectSend');
define('SYSTEM_URI','https://www.projectsend.org/');
define('SYSTEM_URI_LABEL','ProjectSend on github');
define('DONATIONS_URL','https://www.projectsend.org/donations/');

/** Passwords */
define('HASH_COST_LOG2', 8);
define('HASH_PORTABLE', false);

/*Directories and URLs constants */
define('ASSETS_DIR','assets');
define('ASSETS_COMPILED_DIR', ASSETS_DIR . DS . 'dist/');
define('BOWER_DEPENDENCIES_DIR', 'bower_components/');
define('COMPOSER_DEPENDENCIES_DIR', 'vendor/');
define('NPM_DEPENDENCIES_DIR', 'node_modules/');
define('EMAIL_TEMPLATES_DIR', ADMIN_VIEWS_DIR . DS . 'emails');
define('TEMPLATES_DIR', ROOT_DIR . DS . 'templates');
define('WIDGETS_DIR', ADMIN_VIEWS_DIR . DS . 'widgets');
define('VAR_DIR', ROOT_DIR . DS . 'var');
define('CACHE_DIR', VAR_DIR . DS . 'cache');
define('LOG_DIR', VAR_DIR . DS . 'log');

/* Define the folder where uploaded files will reside */
define('UPLOADED_FILES_ROOT', ROOT_DIR . DS . 'upload');
define('UPLOADED_FILES_DIR', UPLOADED_FILES_ROOT . DS . 'files');
define('THUMBNAILS_FILES_DIR', UPLOADED_FILES_ROOT . DS . 'thumbnails');
define('UPLOADED_FILES_URL', 'upload/files/');

/* Branding */
define('ADMIN_UPLOADS_DIR', UPLOADED_FILES_ROOT . DS . 'admin');
define('LOGO_MAX_WIDTH', 300);
define('LOGO_MAX_HEIGHT', 300);
define('DEFAULT_LOGO_FILENAME', 'projectsend-logo.svg');

/* Thumbnails */
define('THUMBS_MAX_WIDTH', 300);
define('THUMBS_MAX_HEIGHT', 300);
define('THUMBS_QUALITY', 90);

/* Assets */
define('ASSETS_IMG_DIR', ROOT_DIR . DS . ASSETS_DIR . DS . 'img/');

/* Default e-mail templates files */
define('EMAIL_TEMPLATE_HEADER', 'header.html');
define('EMAIL_TEMPLATE_FOOTER', 'footer.html');
define('EMAIL_TEMPLATE_NEW_CLIENT', 'new-client.html');
define('EMAIL_TEMPLATE_NEW_CLIENT_SELF', 'new-client-self.html');
define('EMAIL_TEMPLATE_CLIENT_EDITED', 'client-edited.html');
define('EMAIL_TEMPLATE_NEW_USER', 'new-user.html');
define('EMAIL_TEMPLATE_ACCOUNT_APPROVE', 'account-approve.html');
define('EMAIL_TEMPLATE_ACCOUNT_DENY', 'account-deny.html');
define('EMAIL_TEMPLATE_NEW_FILE_BY_USER', 'new-file-by-user.html');
define('EMAIL_TEMPLATE_NEW_FILE_BY_CLIENT', 'new-file-by-client.html');
define('EMAIL_TEMPLATE_PASSWORD_RESET', 'password-reset.html');

/* Set a page for each status code */
define('STATUS_PAGES_DIR', ADMIN_VIEWS_DIR . DS . 'http_status_pages');
define('PAGE_STATUS_CODE_403', STATUS_PAGES_DIR . DS . '403.php');
define('PAGE_STATUS_CODE_404', STATUS_PAGES_DIR . DS . '404.php');

/**
 * Footable
 * Define the amount of items to show
 * @todo Get this value from a cookie if it exists.
 */
if (!defined('FOOTABLE_PAGING_NUMBER')) {
    define('FOOTABLE_PAGING_NUMBER', '10');
    define('FOOTABLE_PAGING_NUMBER_LOG', '15');
}
if (!defined('RESULTS_PER_PAGE')) {
    define('RESULTS_PER_PAGE', '10');
    define('RESULTS_PER_PAGE_LOG', '15');
}

/** External links */
define('LINK_DOC_RECAPTCHA', 'https://developers.google.com/recaptcha/docs/start');
define('LINK_DOC_GOOGLE_SIGN_IN', 'https://developers.google.com/identity/protocols/OpenIDConnect');
