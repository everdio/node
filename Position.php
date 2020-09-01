<?php
namespace Modules\Node {
    use \Components\Validator;
    final class Position extends \Components\Validation {
        public function __construct(int $limit) {
            parent::__construct(sprintf("position() <= %b", $limit), [new Validator\IsString]);
        }
    }
}