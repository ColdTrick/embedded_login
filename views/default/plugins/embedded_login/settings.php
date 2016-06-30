<?php

$embed = elgg_view('embedded_login/embed_html');

echo elgg_echo("embedded_login:settings:info");
echo elgg_view("input/plaintext", [
	"value" => $embed,
	"rows" => 20,
	"id" => "embedded-login-textarea",
]);

?>
<style>
#embedded_login-settings .elgg-button-submit {
	display: none;
}

#embedded-login-textarea {
	height: 170px;
}
</style>
