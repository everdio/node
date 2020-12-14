<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Create extends \Components\Validation {
        public function __construct(\Components\Core $mapper) {
            $node = (isset($mapper->current) ? $mapper->xpath($mapper->current)->item(0) : $mapper->createElement(strtolower($mapper->tag)));
            
            if (isset($mapper->{$mapper->tag})) {        
                $node->nodeValue = false;

                $node->appendChild($mapper->createCDATASection($mapper->{$mapper->tag}));
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