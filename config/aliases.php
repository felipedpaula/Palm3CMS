<?php
$pckJson = file_get_contents(base_path('package.json'));
$pckConfigs = json_decode($pckJson, true);

/**
 * Configs personalizadas do projeto
 */
return [
	'protocol' => env('PROTOCOL', 'https://'),
	// 'auth_url' => env('AUTH_URL', ''),
	// 'api_url' => env('API_URL', ''),
	// 'mobile_url' => env('MOBILE_URL', ''),
	// 'youtube_api_key' => env('YOUTUBE_API_KEY', ''),
	// 'youtube_client_id' => env('YOUTUBE_CLIENT_ID', ''),
	// 'google_client_id' => env('GOOGLE_CLIENT_ID', ''),
	// 'google_recaptcha_site' => env('GOOGLE_RECAPTCHA_SITE_KEY', ''),
	// 'google_recaptcha_secret'	=> env('GOOGLE_RECAPTCHA_SECRET_KEY', ''),
	// 'fb_app_token' => env('FB_APP_TOKEN', ''),
	// 'fb_reactions_urls' => env('FB_REACTIONS_URLS', ''),
	// 'bundle_ver' => $pckConfigs['aliasConfigs']['bundleVer'],
	'scripts_ver' => $pckConfigs['aliasConfigs']['scriptsVer'],
	'styles_ver' => $pckConfigs['aliasConfigs']['stylesVer'],
];
