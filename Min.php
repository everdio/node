<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Min extends \Components\Validation {
        public function __construct(\Components\Core $mapper, string $parameter) {
            parent::__construct(sprintf("[@%s[not(. < ../%s/@%s)]][1]", $mapper->getField($parameter), strtolower($mapper->label), $mapper->getField($parameter)), [new Validator\IsString]);
        }
    }
}