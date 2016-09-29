<?php

/**
 * file.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: working with files & folders
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function deleteDir($dirPath)
{
	if(!is_dir($dirPath))
	{
		throw new InvalidArgumentException('$dirPath must be a directory');
	}
	if(substr($dirPath, strlen($dirPath)-1, 1)!='/')
	{
		$dirPath.='/';
	}
	$files=glob($dirPath.'*', GLOB_MARK);
	foreach($files as $file)
	{
		if(is_dir($file))
		{
			deleteDir($file);
		}
		else
		{
			unlink($file);
		}
	}
	rmdir($dirPath);
}
