<?php
namespace Modules\Node {
    final class Find extends \Components\Validation {
        public function __construct(string $xpath, array $validations = [], string $wrap = "%s") {
            $xparts = $parts = explode(DIRECTORY_SEPARATOR, preg_replace('/\[(.*?)\]/', false, $xpath));
            foreach ($validations as $validation) {
                if ($validation instanceof \Components\Validation && $validation->isValid()) {    
                    if (array_key_exists(($last = array_key_last(array_intersect(($fparts = explode(DIRECTORY_SEPARATOR, ($fpath = preg_replace('/\[(.*?)\]/', false, ($validation = $validation->execute()))))), $parts))), $xparts)) {
                        $validation = str_replace($fpath, false, $validation);
                        if (!sizeof(array_diff($fparts, $parts))) {    
                            $xparts[$last] .= $validation;                        
                        } elseif (sizeof(array_diff($fparts, $parts))) {                        
                            $xparts[$last] .= sprintf("[./%s]", implode(DIRECTORY_SEPARATOR, array_diff($fparts, $parts)) . $validation);
                        }
                    }
                }
            }
            
            parent::__construct(sprintf($wrap, DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $xparts)), [new \Components\Validator\IsString\IsPath]);
        }
    }
}

            
            