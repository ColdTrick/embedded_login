<?php

	function embedded_login_init() {
		elgg_register_page_handler("embedded_login", "embedded_login_page_handler");
	}

	function embedded_login_page_handler($page) {
		global $CONFIG;
		
		// we do not support extends when embedding the login form
		unset($CONFIG->views->extensions["forms/login"]);
		unset($CONFIG->views->extensions["login/extend"]);
		
		echo elgg_view("embedded_login/js_login_form");
		return true;
	}
	
	function embedded_login_walled_garden_handler($hook, $type, $return, $params){
		$result = $return;
	
		$result[] = "embedded_login";
			
		return $result;
	}

	// register default elgg events
	elgg_register_event_handler("init", "system", "embedded_login_init");
	
	elgg_register_plugin_hook_handler("public_pages", "walled_garden", "embedded_login_walled_garden_handler");
