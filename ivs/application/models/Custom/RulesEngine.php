<?php
if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class RulesEngine {
    
    private $rule = null;
    
    function __construct() {  
    }
    
    public function setRule($rule) {
        
        $this->rule = $rule;
    }
    
    public function applyRule($conditions) {
        
       return $this->rule->apply($conditions);
        
    }
    
}
