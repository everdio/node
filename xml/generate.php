<?php
$dom = new \DOMDocument("1.0", "UTF-8");
$dom->load($this->model["document"], LIBXML_HTML_NOIMPLIED | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NONET | LIBXML_NOWARNING);
$dom->preserveWhiteSpace = false;
$dom->formatOutput = false;

$xpath = new \DOMXPath($dom);

foreach ($xpath->query("//*") as $node) {
    $model = new \Modules\Node\Xml\Model;
    $model->document = $dom->documentURI;
    $model->node = $node;
    $model->namespace = $this->model["namespace"];
    $model->use = "\Modules\Node\Xml";
    $model->setup();
    $this->echo(sprintf("%s\%s", $model->namespace, $model->class));
}   
