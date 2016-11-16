<?php
if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of Rule_002
 * Check the inventory status
 * 
 * returns inventory status
 * 
 * @author lbigram
 * 
 * 
 */
class Rule_002 implements IRules{
    
    
    function __construct() {   
    }
    
    public function apply($conditions = array()) {
        
        $result = array();
        // default
        $status = $conditions['status'];
        
        if($conditions['status'] != 'DISCONTINUED') {
            // check quantity available
            if ($conditions['quantityavailable'] == 0) {
                $status = 'OUT OF STOCK';
            } else if ($conditions['quantityavailable'] > 0) {
                $status = 'AVAILABLE';
            }
        }

        $result['status'] = $status;
        return $result;
     
                           
    }

}
