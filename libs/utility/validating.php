<?php

/**
 * validating.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: validating functions
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function email_validation($email)
{
	$pattern='/^[-a-z0-9]+((\_[-a-z0-9~!$%^&*=+}{\?]+)*|(\.[-a-z0-9~!$%^&*=+}{\?]+)*)+@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/';
	if(preg_match($pattern, $email))
	{
		return true;
	}
	return false;
}

function cell_validation($cell)
{
	$pattern='/^09([0-9]{9})$/';
	if(preg_match($pattern, $cell))
	{
		return true;
	}
	return false;
}
