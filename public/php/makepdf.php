
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



if (isset($_POST['timeReport']) && isset($_POST['name']) && isset($_POST['momsperiod']) ) {

	// Add a page. To override above page defaults, you could add
	// another $options array as second argument.
	$html = file_get_contents("../views/pdf/pdf.html");

	//TimeReport
	$html_with_values = str_replace("<td><!--fk-".$_POST['timeReport']."-", "<td class='fk-todo'>Tidr<!--fk-".$_POST['timeReport']."-", $html);

	// $html_with_values = str_replace("<!--fk-".$_POST['timeReport']."-", "Tidr<!--", $html);
	
	//Name
	$html_with_values = str_replace('%name%', $_POST['name'], $html_with_values);
	
	//Moms
	if ($_POST['momsperiod'] == 1) {
		$html_with_values = str_replace('<td><!--fk-16-jan', "<td class='fk-todo'>Moms<!--fk-16-jan", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-16-aug', "<td class='fk-todo'>Moms<!--fk-16-feb", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-feb', "<td class='fk-todo'>Moms<!--fk-16-mar", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-mar', "<td class='fk-todo'>Moms<!--fk-16-apr", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-apr', "<td class='fk-todo'>Moms<!--fk-16-maj", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-maj', "<td class='fk-todo'>Moms<!--fk-16-jun", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-jun', "<td class='fk-todo'>Moms<!--fk-16-jul", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-jul', "<td class='fk-todo'>Moms<!--fk-16-aug", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-sep', "<td class='fk-todo'>Moms<!--fk-16-sep", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-okt', "<td class='fk-todo'>Moms<!--fk-16-okt", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-nov', "<td class='fk-todo'>Moms<!--fk-16-nov", $html_with_values);
		$html_with_values = str_replace('<td><!--fk-12-dec', "<td class='fk-todo'>Moms<!--fk-16-dec", $html_with_values);
	}

	file_put_contents('../views/pdf/build/pdf'.$guid.'.html', $html_with_values);
}
echo $guid;

if (isset($_GET['guid'])) {
		# code...
	$pdf->addPage('../views/pdf/build/pdf'.$_GET['guid'].'.html');

	$pdf->send();
}

 ?>
