<?php
if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


/**
 *
 * @author lbigram
 */
interface IRules {
    
    public function apply($conditions=array());
    
}
