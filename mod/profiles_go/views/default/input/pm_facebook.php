<?php

if (empty($vars['placeholder'])) {
	$vars['placeholder'] = elgg_echo('profiles_go:pm_facebook:input:placeholder');
}

echo elgg_view('input/url', $vars);