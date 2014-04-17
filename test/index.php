<?php 
include "../dist/ralf.php";
ralf::import("dom.model.themeHtml");

$theme = new themeHtml();
$theme->setPathTheme("modelo/modelo.html");

$presio = $theme->getElement("#valorPresio");
$presio->innertext = "$ 14.00.-";

$theme->out();