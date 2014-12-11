<?php
function hashtag($link)
	{
		//convert url to <a> links
		//$link = preg_replace("/([\w]+\:\/\[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $link);

		//convert hashtags to search
		$link = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_blank\" href=\"http://google.com/search?q=$1\">#$1</a>", $link);

		//convert attags 
		$link = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a target=\"_blank\" href=\"http://twitter.com/$1\">@$1</a>", $link);

		return $link;
	}
?>