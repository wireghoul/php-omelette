<?php
require("dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$html = '
<html>
<head>
<style>
body {background-color: powderblue;}
h1   {color: blue;}
p    {color: red;}
</style>
</head>
<body>
<h1>Test</h1>
<?=phpinfo();?>
<script type="text/php">
if ( isset($pdf) ) {
  $font = Font_Metrics::get_font("helvetica", "bold");
  $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
}
phpinfo();
</script>
...
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream();
?>
