<?php
include 'prince.php';
$prince = new Prince('C:\\Prince\\Engine\\bin\\prince.exe');
$prince->addStyleSheet('C:\\wamp\\www\\resume\\css\\css.css');
$prince->setLog("C:\\Windows\\Temp\\Prince.log");
//$output = system("C:\\Prince\\Engine\\bin\\prince.exe --version");
echo $_POST["html"];
try {
$created_pdf = $prince->convert_string_to_file($_POST['html'], "c:\\wamp\\www\\resume\\pdfs\\".uniqid().".pdf");


} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
