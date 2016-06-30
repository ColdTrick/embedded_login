<?php

$site_link = elgg_view("output/url", [
	"text" => elgg_get_site_entity()->name,
	"href" => elgg_get_site_url(),
]);

$js_url = elgg_normalize_url("embedded_login");

?>
<div id="elgg-embedded-login"><?= $site_link ?></div>
<script>
(function(d, id) {
	if (d.getElementById(id)) return;
	var js = d.createElement('script');
	js.id = id;
	js.src = <?= json_encode($js_url) ?>;
	d.body.appendChild(js);
}(document, 'elgg-embedded-login-js'));
</script>