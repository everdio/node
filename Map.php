<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Map extends \Components\Validation {
        public function __construct(\Components\Core $mapper, \DOMElement $node) {
            $mapper->current = $node->getNodePath();          
            $mapper->parent = $node->parentNode->getNodePath();                            
            $mapper->{$mapper->label} = trim($node->nodeValue);           
            if (isset($mapper->mapping)) {                
                foreach ($mapper->mapping as $attribute => $parameter) {
                    if ($mapper->exists($parameter)) {
                        $mapper->{$parameter} = $node->getAttribute($attribute);
                    }
                }
            }
            
            parent::__construct($mapper, [new Validator\IsObject\Of("\Components\Core")]);
        }
    }
}