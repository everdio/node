<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Save extends \Components\Validation {
        public function __construct(\Components\Core\Mapper $mapper) {
            $create = new Create($mapper);
            $node = $create->execute();
            if (!isset($mapper->current) && isset($mapper->parent)) {                        
                $mapper->xpath($mapper->parent)->item(0)->appendChild($node);
            } elseif (!isset($mapper->current) && !isset($mapper->parent) && isset($mapper->path)) {
                $mapper->xpath(implode(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, $mapper->path), 0, -1)))->item(0)->appendChild($node);
            }    
            
            parent::__construct($node, [new Validator\IsObject\Of("\DOMElement")]);
        }
    }
}