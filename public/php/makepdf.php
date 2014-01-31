
<?php
require_once '../includes/WkHtmlToPdf.php';


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

$guid = uniqid();


if (isset($_POST['name'])) {

	// Add a page. To override above page defaults, you could add
	// another $options array as second argument.
	$html = file_get_contents('../views/pdf/pdf.html');
	$html_with_values = str_replace('%name%', $_POST['name'], $html);
	

	file_put_contents('../views/pdf/build/pdf'.$guid.'.html', $html_with_values);
	}
	echo $guid;

	if (isset($_GET['guid'])) {
		# code...
	$pdf->addPage('../views/pdf/build/pdf'.$_GET['guid'].'.html');

	$pdf->send();
	}

 ?>
