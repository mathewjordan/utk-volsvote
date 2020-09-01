<?php
// main calendar feed    
$feedURL = "http://creative.utk.edu/tag/wordpress-update/feed/";  
  
// read feed into SimpleXML    
$sxml = simplexml_load_file($feedURL);  
$i=0;
//var_dump($sxml->channel->item->title);
//echo $sxml->asXML(); 
foreach ($sxml->channel->item as $entry) 

{      
$title = stripslashes($entry->title); 
$finalTitle = str_replace("â", "&rsquo;",$title);
$finalTitle2 = str_replace("â", "&lsquo;",$finalTitle);

$link = stripslashes($entry->link); 

$description = stripslashes($entry->description); 
$finalDescription = str_replace("â", "&rsquo;",$description);
$finalDescription2 = str_replace("â", "&lsquo;",$finalDescription);
$finalDescription3 = str_replace("--", "&mdash;",$finalDescription2);
$finalDescription4 = substr($finalDescription3, 0, 150);
$finalDescription5 = $finalDescription4.'... [<a href="'.$link.'" target="_blank">more</a>]';

$date = stripslashes($entry->pubDate); 
$dateForm = substr($date, 0, 16); 


echo "<div class='news-item'>";
echo "<h4><a href='$link' target='_blank'>$finalTitle2</a></h4>";
echo "<p class='post-info'>$dateForm</p>";
echo "<p>$finalDescription5</p>";
echo "</div>\n";


if ($i=1) 
	{break;}
}		
$i++;	
?>