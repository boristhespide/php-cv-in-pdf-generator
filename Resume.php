<?php
require_once ("Printer.php");
class Resume
{
    public string $name;
    public string $position;
    public string $about;
    public string $gitLink;
    public string $email;

    public function __construct() {
        $this->name = htmlspecialchars($_POST["name"]);
        $this->position = htmlspecialchars($_POST["position"]);
        $this->about = htmlspecialchars($_POST["about"]);
        $this->gitLink = htmlspecialchars($_POST["gitLink"]);
        $this->email = htmlspecialchars($_POST["email"]);

    }

    public function makeTemplate(): string {
        $html = file_get_contents("template.html");

        $html = str_replace(["{{ name }}", "{{ position }}", "{{ about }}", "{{ gitLink }}", "{{ email }}"], [$this->name, $this->position, $this->about, $this->gitLink, $this->email], $html);

        return $html;
    }
}