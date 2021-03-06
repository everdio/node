<?php
namespace Modules\Node {
    use \Component\Validator;
    final class Join extends \Component\Validation {
        public function __construct(array $paths = [], array $joined = []) {
            foreach ($paths as $path) {
                if ($path instanceof Path) {
                    $joined[] = $path->execute();
                }
            }
           
            parent::__construct(implode("|", $joined), [new Validator\IsString\Contains(["|"])]);
        }
    }
}

            
            