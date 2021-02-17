<?php
namespace Modules\Node {
    trait Html {
        use \Modules\Node;
        protected function initialise() {
            if (!$this->hadAdapter($this->unique(["document"]))) {
                $dom = new \DOMDocument;
                $dom->preserveWhiteSpace = false;
                $dom->loadHTMLFile($this->document, LIBXML_HTML_NOIMPLIED | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NONET | LIBXML_NOWARNING);                                    
                
                $this->addAdapter($this->unique(["document"]), $dom);                
            }   
            
            return (object) $this->getAdapter($this->unique(["document"]));            
        }        
        
        public function innerHTML(\DOMElement $node) : string {
            return (string) implode(array_map([$node->ownerDocument, "saveHTML"], iterator_to_array($node->childNodes)));            
        }
    }
}