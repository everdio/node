<?php
namespace Modules\Node {
    use \Component\Validator;
    final class Map extends \Component\Validation {
        public function __construct(\Component\Core $mapper, \DOMElement $node) {
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
            
            parent::__construct($mapper, [new Validator\IsObject\Of("\Component\Core")]);
        }
    }
}