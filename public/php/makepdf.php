<?php
 
require_once "../includes/dompdf/dompdf_config.inc.php";
 
$dompdf = new DOMPDF();
 
$html = <<<'ENDHTML'
<html>
 <body>
  <h1>Hello Dompdf</h1>
 </body>
</html>
ENDHTML;
 
$dompdf->load_html($html);
$dompdf->render();
 
$dompdf->stream("hello.pdf");





 ?>