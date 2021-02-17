<?php
namespace Modules\Node {
    trait Xml {
        use \Modules\Node;
        protected function initialise() {
            if (!$this->hadAdapter($this->unique(["document"]))) {
                $dom = new \DOMDocument;
                $dom->preserveWhiteSpace = false;
                $dom->load($this->document, LIBXML_HTML_NOIMPLIED | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NONET | LIBXML_NOWARNING);                 
                
                $this->addAdapter($this->unique(["document"]), $dom);
            }
            
            return (object) $this->getAdapter($this->unique(["document"]));
        }        
    }
}