<?php
/*This scraper for Federal Sharait Court of Criminal Cases.
Link :  http://federalshariatcourt.gov.pk/c1.html
Created By Vikash Harjeewan
Date  : 3/1/2018
I added daily schedules for scrape updated data regular
*/
require	'simple_html_dom.php';
//require 'scraperwiki.php';
//require 'scraperwiki/simple_html_dom.php';
//totalpages is for future if you saw there is more than 36 pages just change number in totalpages=	;
//http://federalshariatcourt.gov.pk/11.html

$totalpages   = 1;

for($page = 1;$page <= $totalpages; $page++)
	{
		$link	=	'http://federalshariatcourt.gov.pk/'.$page.'.html';
		$html	=	file_get_html($link);
		foreach($html->find("/html/body/table/tbody/tr[3]/td/table[1]/tbody/tr[2]/td[2]/table[2]/tbody/tr/td/table/tbody/tr") as $element)
		{
		$no 	=	$element->find("td[1]",0)->plaintext;
		 if (is_numeric($no) == true) 
		 { 
			$s_no 		=	$element->find("td[1]",0)->plaintext;
			$appeal 	=	$element->find("td[2]",0)->plaintext;
			$convic 	=	$element->find("td[3]",0)->plaintext;
			$decision 	=	$element->find("td[4]",0)->plaintext;
			echo $s_no.'<br>';
			scraperwiki::save_sqlite(array('s_no'), array('s_no'=> $s_no,'appeal'=> $appeal,'convic'=> $convic,'decision'=> $decision,'link'=> $link));
			
		 } 
		}
	
	}
?>
