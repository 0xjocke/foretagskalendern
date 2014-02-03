
<?php
	require_once '../includes/WkHtmlToPdf.php';
	require_once '../includes/PDF_Creator.php';


	// Create a new WKHtmlToPdf object with some global PDF options
	$pdf = new WkHtmlToPdf(array(
	    'no-outline',         // Make Chrome not complain
	    'binPath' => 'C:\Program Files (x86)\wkhtmltopdf\wkhtmltopdf.exe',
	    'margin-top'    => 0,
	    'margin-right'  => 0,
	    'margin-bottom' => 0,
	    'margin-left'   => 0,
	));

	// Set default page options for all following pages
	$pdf->setPageOptions(array(
	    'disable-smart-shrinking',
	    'user-style-sheet' => '../views/pdf/css/pdf.css',
	));

	if (isset($_POST['timeReport']) && isset($_POST['name']) && isset($_POST['momsperiod']) ) {

		$pdf_creator = new PDF_Creator;
		$pdf_creator->add_name();
		
		//If moms every month and timereport on 12th
		if ($_POST['timeReport'] == 12 && $_POST['momsperiod'] == 1) {
			$pdf_creator->add_moms_and_time_12();
		//If moms every month and timereport on 16th
		}elseif ($_POST['timeReport'] == 16 && $_POST['momsperiod'] == 1){
			$pdf_creator->add_moms_and_time_16();
		}else{
			// if Timereport not 0
			if ($_POST['timeReport'] != 0) {
				$pdf_creator->add_time_report($_POST['timeReport']);
			}
			
			//Moms
			if ($_POST['momsperiod'] == 1) {
				$pdf_creator->add_momsperiod_month();
			}
			if ($_POST['momsperiod'] == 2) {
				$pdf_creator->add_momsperiod_quarter();
			}
			if ($_POST['momsperiod'] == 3) {
				$pdf_creator->add_momsperiod_year();
			}
		}
		if (isset($_POST['financialStatement'])) {
			$pdf_creator->add_financial_statement($_POST['financialStatement']);
		}
		// have to call finacialStatement before..
		if (isset($_POST['extraDate'])) {
			$pdf_creator->add_extra($_POST['extraDate'],$_POST['extra']);
		}




		//save to file
		$pdf_creator->put_contents();
		//echo guid so js/ajax can pick it up.
		echo $pdf_creator->get_guid();
	}

	if (isset($_GET['guid'])) {
			# code...
		$pdf->addPage('../views/pdf/build/pdf'.$_GET['guid'].'.html');

		$pdf->send();
	}

 ?>
