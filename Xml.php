<?php
namespace Modules\Node {
    trait Xml {
        use \Modules\Node;
        final protected function getDocument() : \DOMDocument {
            $dom = new \DOMDocument;
            $dom->preserveWhiteSpace = false;
            $dom->loadFile($this->document, LIBXML_HTML_NOIMPLIED | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NONET | LIBXML_NOWARNING); 
            return (object) $dom;
        }
    }
}