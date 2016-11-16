<?php
if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of Rule_001
 * Check whether inventory item should be flagged due to being low
 * 
 * Returns flag value
 * 
 * @author lbigram
 * 
 * 
 */
class Rule_001 implements IRules{
    
    
    function __construct() {   
    }
    
    public function apply($conditions = array()) {
        
        $result = array();
        // default
        $flag = 2;
        
        if($conditions['status'] != 'DISCONTINUED') {
            // the quantityavaible is less than the minimum quantity, flag the inventory
            if($conditions['quantityavailable'] <= $conditions['minimumquantity']) { $flag = 1;
            }// there is sufficient quantity available 
            else { $flag = 2; }
        }
        
        
        $result['flag'] = $flag;
        return $result;
     
                           
    }

}
