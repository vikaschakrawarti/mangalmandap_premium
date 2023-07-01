<?php		
function pagination($limit,$adjacents,$rows,$page){	
	$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	if($lastpage > 1){	
		if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\"><i class=\"fa fa-chevron-left\"></i></a>";
		else{
			//$pagination.= "<span class=\"disabled\">previous</span>";	
			}


		//pages	
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers1' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers1' href=\"?page=$counter\">$counter</a>";					

				}
			$last.= "<a class='page-numbers1' href=\"?page=$lastpage\">Last</a>";			
			}

			//in middle; hide some front and some back

			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers1' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers1' href=\"?page=$counter\">$counter</a>";					

				}
				$last.= "<a class='page-numbers1' href=\"?page=$lastpage\">Last</a>";			

			}
			//close to end; only hide early pages

			else
			{
			    $first.= "<a class='page-numbers1' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current ne_bg_light_grey\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
			}
		if ($page < $counter - 1) 
			$next_.= "
			<a class='page-numbers' href=\"?page=$next\"><i class=\"fa fa-chevron-right\"></i></a>";
		else{
			//$pagination.= "<span class=\"disabled\">next</span>";
			}
		$pagination = "<div class=''><div class=''>
		<ul class=\"pagination\" ><li>".$prev_.$pagination."</li><li>".$next_.$last."</li>";
		//next button
		$pagination.= "</ul></div></div>\n";	
	}
	echo $pagination;  
}
?>

<style>
    nav.center-text,nav{
        background:none;	
    }
    .pagination{
        margin:-6px 0px;	
    }
    .current{
        background: none repeat scroll 0 0 rgba(236, 236, 236, 1) !important;
        color: #000 !important;
        padding:4px 8px;
    }

    .pagination > li > a{
        padding:8px 12px;	
    }

    .page-numbers1{
        display:none;	
    }

    .ne-success-story ul{
        border-bottom:none !important;	
    }
    .ne-success-story li{
        background: none !important;
        border-bottom:none !important;	
    }
</style>