<?php

	require_once("kanji/core/URIController.php");
	require_once("kanji/core/ClassLoader.php");
	require_once("kanji/core/Kanji.php");
	
	// should URIController be a static class?
	$uri= new URIController("/kanji");
	ClassLoader::loadClassFromURI($uri);
	
/* end file
*/