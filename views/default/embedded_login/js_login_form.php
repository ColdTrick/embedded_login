<?php

$login_form_html = elgg_view('embedded_login/login_form');

?>
//<script>
var embedded_login = document.getElementById("elgg-embedded-login");
if (embedded_login) {
	embedded_login.innerHTML = <?= json_encode($login_form_html) ?>;
}
