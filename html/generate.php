<?php

$dom = new \DOMDocument;
$dom->loadHTMLFile($this->model["document"], LIBXML_HTML_NOIMPLIED | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NONET | LIBXML_NOWARNING);
$xpath = new \DOMXPath($dom);
foreach ($xpath->query("//*") as $node) {
    $model = new \Modules\Node\Html\Model;
    $model->document = $dom->documentURI;
    $model->node = $node;
    $model->namespace = $this->model["namespace"];
    $model->use = "\Modules\Node\Html";
    $model->setup();
    echo (string) sprintf("%s\%s", $model->namespace, $model->class) . PHP_EOL;    
    ob_flush();     
}   