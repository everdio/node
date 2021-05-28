<?php
namespace Modules\Node {
    trait Xml {
        use \Modules\Node;
        protected function initialize() {
            if (!\array_key_exists($this->document, self::$adapters)) {
                $dom = new \DOMDocument;
                $dom->load($this->document, LIBXML_HTML_NOIMPLIED | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NONET | LIBXML_NOWARNING);
                self::$adapters[$this->document] = $dom;
            }
            
            return (object) self::$adapters[$this->document];
        }             
    }
}