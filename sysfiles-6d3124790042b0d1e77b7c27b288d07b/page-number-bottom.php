<?php

// mencari jumlah semua data dalam tabel
$jumData = cekData($AllDataQry);

if($jumData>$dataPerPage)
{
	// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
	$jumPage 	= ceil($jumData/$dataPerPage);
	$TextAlign	= $TextAlign??"center";

	echo '<div class="d-block my-3 text-center">';
	/* if($device->isMobile())
	{ */

		echo '<div class="input-group mx-auto" style="max-width:300px;">';

			echo '<div class="input-group-prepend">';
					$textMuted	=$_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]==1?" text-muted":"";
					$btnDisabled=$_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]==1?" disabled":"";
			echo '	<button class="btn btn-light border nav-page-start'.$textMuted.'"'.$btnDisabled.'><i class="fa-solid fa-backward-fast"></i></button>';
			echo '	<button class="btn btn-light border nav-page-prev'.$textMuted.'"'.$btnDisabled.' style="width:70px;"><i class="fa-solid fa-caret-left"></i></button>';
			echo '</div>';
				
			echo '<select class="form-control text-center nav-page-number" url="'.($PrefixurlPgNum.'-page-{{pgnum}}.html').'">';
			for($page=1; $page<=$jumPage; $page++){ echo '<option value="'.$page.'"'.($_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]==$page?" selected":"").'>'.$page.'</option>'; }
			echo '</select>';
				
			echo '<div class="input-group-append">';
					$textMuted	=$_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]==$jumPage?" text-muted":"";
					$btnDisabled=$_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]==$jumPage?" disabled":"";
			echo '	<button class="btn btn-light border nav-page-next'.$textMuted.'"'.$btnDisabled.' style="width:70px;"><i class="fa-solid fa-caret-right"></i></button>';
			echo '	<button class="btn btn-light border nav-page-end'.$textMuted.'"'.$btnDisabled.'><i class="fa-solid fa-forward-fast"></i></button>';
			echo '</div>';

		echo '</div>';
	/* }
	else
	{
		echo '<div style="text-align: <?php echo $TextAlign; ?>;"><div class="btn-group" role="group">';
		
		// menampilkan link previous
		$href=$_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]>1?($PrefixurlPgNum.'-page-'.($_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]-1).'.html'):"#";
		echo  '<a '.$classPgNumA.' data-ajax="false" href="'.$href.'">&nbsp;&laquo;&nbsp;</a>';
		
		// memunculkan nomor halaman dan linknya
		for($page = 1; $page <= $jumPage; $page++)
		{
			if ((($page >= $_SESSION["sess"]["sessionPageNumber"][$PgNumSesID] - 3) && ($page <= $_SESSION["sess"]["sessionPageNumber"][$PgNumSesID] + 3)) || ($page == 1) || ($page == $jumPage))
			{
				//if (($showPage == 1) && ($page != 2))  							echo '<a '.$classPgNumA.' href="#">...</a>';
				//if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) 		echo '<a '.$classPgNumA.' href="#">...</a>';
				if ($page == $_SESSION["sess"]["sessionPageNumber"][$PgNumSesID])	echo '<a '.$classPgNumB.' data-ajax="false" href="#" style="font-weight:bold;">'.$page."</a>";
				else 																echo '<a '.$classPgNumA.' data-ajax="false" href="'.$PrefixurlPgNum.'-page-'.$page.'.html">'.$page.'</a>';
				$showPage = $page;
			}
		}

		// menampilkan link next
		$href=$_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]<$jumPage?($PrefixurlPgNum.'-page-'.($_SESSION["sess"]["sessionPageNumber"][$PgNumSesID]+1).'.html'):"#";
		echo '<a '.$classPgNumA.' data-ajax="false" href="'.$href.'">&nbsp;&raquo;&nbsp;</a>';
		
		echo '</div></div>';	
	} */
	echo '</div>';
}