<?php

if (empty($vars['placeholder'])) {
	$vars['placeholder'] = elgg_echo('profiles_go:pm_twitter:input:placeholder');
}

echo elgg_view('input/text', $vars);