<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Unique extends \Components\Validation {
        public function __construct(string $tag, string $attribute = ".") {
            parent::__construct(sprintf("[not(%s = %s/%s)]",$attribute, strtolower($tag), $attribute), [new Validator\IsString]);
        }
    }
}