<?php

	$login_form_html = elgg_view_form('login');
	
	$login_form_html .= <<<STYLE
	<style type="text/css">
		#elgg-embedded-login fieldset {
			border: none;
			margin: 0;
			padding: 0;
		}
		
		#elgg-embedded-login .elgg-menu {
			list-style: none;
			padding: 0;
		}
		
		#elgg-embedded-login .elgg-menu li {
			display: inline-block;
		}
	</style>
STYLE;
	
	
	$login_form_html = str_replace(array("\n", "\r", PHP_EOL), "", $login_form_html);
	
	$login_form_html = addslashes($login_form_html);

?>

var embedded_login = document.getElementById("elgg-embedded-login");
if (embedded_login) {
	embedded_login.innerHTML = "<?php echo $login_form_html; ?>";
}
