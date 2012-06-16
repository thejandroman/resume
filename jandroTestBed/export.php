<?php
$format = $_GET["format"];
if($format == "docx")
{
ob_end_clean();
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=document_name.doc");

echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo $_POST["html"];
echo "</body>";
echo "</html>";
}
else
{
ob_end_clean();
require_once('./tcpdf/config/lang/eng.php');
require_once('./tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('Resumaze');
$pdf->SetAuthor('Resamaze');
$pdf->SetTitle('Resume');
$pdf->SetSubject('Resume');
$pdf->SetKeywords('Resume');

$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setLanguageArray($l);

//$pdf->setFontSubsetting(true);

//$pdf->SetFont('dejavusans', '', 14, '', true);

$pdf->AddPage();

$html = "";
if (!empty($_POST['css'])){
  $css = '';
  if(is_file($_POST['css']))
  {
	$css = file_get_contents($_POST['css']);
  }
  else
  {
	$css = $_POST['css'];
  }
  $html .= "<style>";
  $html .= $css;
  $html .= "</style>";
}

$html .= "{$_POST['html']}";

$pdf->writeHTML($html, true, false, true, false , '');
//$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $_POST['html'], $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

//ob_clean();
$pdf->Output('resume.pdf', 'D');
}
?>