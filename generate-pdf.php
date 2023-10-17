<?php

require_once ("vendor/autoload.php");

use Dompdf\Dompdf;
use Dompdf\Options;

$name = htmlspecialchars($_POST["name"]);
$position = htmlspecialchars($_POST["position"]);
$about = htmlspecialchars($_POST["about"]);
$gitLink = $_POST["gitLink"];
$email = htmlspecialchars($_POST["email"]);


$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);
$options->set('defaultFont', 'DejaVu');

$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "landscape");

$html = file_get_contents("template.html");

$html = str_replace(["{{ name }}", "{{ position }}", "{{ about }}", "{{ gitLink }}", "{{ email }}"], [$name, $position, $about, $gitLink, $email], $html);

$dompdf->loadHtml($html);


$dompdf->render();

$dompdf->addInfo("cv", "резюме для програмиста");

$dompdf->stream('cv.pdf', ["Attachment" => 0]);
