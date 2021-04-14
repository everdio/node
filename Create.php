<?php
namespace Modules\Node {
    use \Component\Validator;
    final class Create extends \Component\Validation {
        public function __construct(\Component\Core $mapper) {
            $node = (isset($mapper->current) ? $mapper->xpath($mapper->current)->item(0) : $mapper->createElement(strtolower($mapper->label)));
            
            if (isset($mapper->{$mapper->label})) {        
                $node->nodeValue = false;
                $node->appendChild($mapper->createCDATASection($mapper->{$mapper->label}));
            }
            
            if (isset($mapper->mapping)) {
                foreach ($mapper->mapping as $attribute => $parameter) {  
                    if (isset($mapper->{$parameter})) {
                        $node->setAttribute($attribute, $mapper->{$parameter});
                    }
                }
            }
            parent::__construct($node, [new Validator\IsObject\Of("\DOMElement")]);
        }
    }
}