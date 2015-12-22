<div>
<label>Message:</label>
<?php
	//This is an instance of the ElggWidget class that represents our widget.
	$widget = $vars['entity'];
	// Give the user a plain text box to input a message
	echo elgg_view('input/text', array(
		'name' => 'params[message]',
		'value' => $widget->message,
		'class' => 'input-text',
	));
	//the edit view remembers what the user typed in the previous time he changed the value of his message text.
?>
</div>
