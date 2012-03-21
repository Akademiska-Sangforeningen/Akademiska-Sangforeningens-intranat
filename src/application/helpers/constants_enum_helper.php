<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Enumerations
 *
 * @author André Brunnsberg
 *
*/

define('ENUM_VOICES',		'enum_voices');
define('ENUM_COUNTRIES',	'enum_countries');

function getEnum($enum) {
	switch($enum) {
		case ENUM_VOICES:
			return array(
					'1T'  	=> 	lang(LANG_KEY_ENUM_VOICE_1_TENOR),
					'2T'  	=> 	lang(LANG_KEY_ENUM_VOICE_2_TENOR),
					'1B'  	=> 	lang(LANG_KEY_ENUM_VOICE_1_BASS),
					'2B'	=>	lang(LANG_KEY_ENUM_VOICE_2_BASS),
					'Dr'	=> 	lang(LANG_KEY_ENUM_VOICE_CONDUCTOR)
					);	
		case ENUM_COUNTRIES:
			return array(
					'fi'  	=> 	lang(LANG_KEY_ENUM_COUNTRY_FINLAND),
					'sv'  	=> 	lang(LANG_KEY_ENUM_COUNTRY_SWEDEN),
					'nn'  	=> 	lang(LANG_KEY_ENUM_COUNTRY_OTHER)
					);	
				
		default:
			return;
	}
}