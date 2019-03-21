<?php
# This file was automatically generated by the MediaWiki 1.26.3
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "Akademiska Sångföreningen";
$wgMetaNamespace = "Akademiska_Sångföreningen";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/wiki";

## The protocol and server name to use in fully-qualified URLs
$wgServer = getenv("HOSTNAME");


## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgResourceBasePath/../images/akademen_wiki_logo.gif";

## UPO means: this is also a user preference option

$wgEnableEmail = false;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "apache@intra.akademiskasangforeningen.fi";
$wgPasswordSender = "apache@intra.akademiskasangforeningen.fi";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

if (getenv('ENV') == "production") {
 $url = getenv('JAWSDB_URL');
} else {
 $url = getenv('DB_URL');
}

$dbparts = parse_url($url);

## Database settings
$wgDBtype = "mysqli";
$wgDBserver =  $dbparts['host'];
$wgDBname = ltrim($dbparts['path'],'/');
$wgDBuser = $dbparts['user'];
$wgDBpassword = $dbparts['pass'];

# MySQL specific settings
$wgDBprefix = "wiki_";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = array();

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = false;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "sv";

$wgSecretKey = "cfc5c74f324e074a9adfe975f3445434958267d68118c8f782903d8816065063";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "9b7ab8c4a33047de";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "";

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['read'] = false;

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'CologneBlue' );
wfLoadSkin( 'Modern' );
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Vector' );


# End of automatically generated settings.
# Add more configuration options below.
error_reporting( -1 );
ini_set( 'display_errors', 1 );

$wgShowSQLErrors = true;
$wgDebugDumpSql  = true;

$wgGroupPermissions['*']['createaccount']   = false;
$wgGroupPermissions['*']['read']            = false;
$wgGroupPermissions['*']['edit']            = false;

// HERE STARTS CUSTOM
ob_start();
$wgCodeIgniter = require_once('../external.php');
ob_end_clean();
$wgCodeIgniter_Name = $wgCodeIgniter->session->userdata('Name');
$wgCodeIgniter_Email = $wgCodeIgniter->session->userdata('Email');

require_once("$IP/extensions/ExtAuthDB/ExtAuthDB.php");
$wgAuth = new ExtAuthDB();

$wgExtensionFunctions[] = function () {
	global $wgAuth;

	if ( $wgAuth instanceof ExtAuthDB ) {
		$wgAuth->setupExtensionForRequest();
	} else {
		die( wfMessage( 'auth_remoteuser-wgautherror' ) );
	}
};

// see http://www.mediawiki.org/wiki/Manual:Hooks/SpecialPage_initList
// and http://www.mediawiki.org/w/Manual:Special_pages
// and http://lists.wikimedia.org/pipermail/mediawiki-l/2009-June/031231.html
// disable login and logout functions for all users
function LessSpecialPages(&$list) {
	unset( $list['Userlogout'] );
	unset( $list['Userlogin'] );
	return true;
}
$wgHooks['SpecialPage_initList'][]='LessSpecialPages';
// HERE ENDS CUSTOM

// http://www.mediawiki.org/wiki/Extension:Windows_NTLM_LDAP_Auto_Auth
// remove login and logout buttons for all users
function StripLogin(&$personal_urls, &$wgTitle) {
	unset( $personal_urls["login"] );
	unset( $personal_urls["logout"] );
	unset( $personal_urls['anonlogin'] );
	return true;
}
$wgHooks['PersonalUrls'][] = 'StripLogin';