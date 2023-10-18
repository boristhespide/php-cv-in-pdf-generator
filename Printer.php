<?php

use Dompdf\Dompdf;
use Dompdf\Options;
require_once ("Resume.php");
class Printer
{

    public function __construct()
    {
        $this->print();
    }

    public function print()
    {
        $options = new Options();
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($options);
        $dompdf->setPaper("A4", "landscape");

        $resume = new Resume();
        $html = $resume->makeTemplate();

        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->stream('Резюме.pdf', ["Attachment" => 0]);

    }

    public function setPrintOptions()
    {
    }
}