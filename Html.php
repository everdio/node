<?php
namespace Modules\Node {
    trait Html {
        use \Modules\Node;
        protected function initialize() {
            if (!\array_key_exists($this->document, self::$adapters)) {
                $dom = new \DOMDocument("1.0", "UTF-8");
                $dom->loadHTMLFile($this->document, LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NONET | LIBXML_NOWARNING);
                $dom->preserveWhiteSpace = false;
                $dom->formatOutput = false;
                
                self::$adapters[$this->document] = $dom;
            }
            
            return (object) self::$adapters[$this->document];
        }        
    }
}