<?php

function embedded_login_init() {
	elgg_register_page_handler("embedded_login", "embedded_login_page_handler");
}

function embedded_login_page_handler() {
	// we do not support extends when embedding the login form
	elgg_register_plugin_hook_handler('view', 'login/extend', 'embedded_login_empty_string');
	$extensions = (array)embedded_login_sniff_extensions('forms/login');
	foreach ($extensions as $extension) {
		elgg_unextend_view('forms/login', $extension);
	}

	header('Content-Type: application/javascript;charset=utf-8');
	echo elgg_view("embedded_login/js_login_form");

	return true;
}

function embedded_login_walled_garden_handler($hook, $type, $return, $params) {
	$return[] = "embedded_login";
	return $return;
}

function embedded_login_empty_string() {
	return "";
}

/**
 * Sniff view extensions
 *
 * @param string $view View name
 * @return array|null extension functions or null on error
 */
function embedded_login_sniff_extensions($view) {
	try {
		if (!function_exists('_elgg_services')) {
			return;
		}
		$svcs = _elgg_services();
		if (!is_object($svcs) || !method_exists($svcs, 'has') || !$svcs->has('views')) {
			return;
		}
		$views = $svcs->views;
		if (!is_object($views) || !method_exists($views, 'getInspectorData')) {
			return;
		}
		$data = $views->getInspectorData();
		// check expected format
		if (empty($data['extensions'][$view])
				|| !isset($data['extensions'][$view][500])
				|| $data['extensions'][$view][500] !== $view) {
			return;
		}
		unset($data['extensions'][$view][500]);
		return $data['extensions'][$view];

	} catch (Exception $e) {
		return;
	}
}

// register default elgg events
elgg_register_event_handler("init", "system", "embedded_login_init");

elgg_register_plugin_hook_handler("public_pages", "walled_garden", "embedded_login_walled_garden_handler");
