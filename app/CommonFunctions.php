<?php
namespace App;

use Auth;
/**
 * Common Function Class
 */
class CommonFunctions
{
     /**
     * checkbox checked function
     *
     **/
    public static function checkedCheckbox($input)
    {
        if ($input) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Calculate Discount for Fee
     *
     * on this function check student register time any fee offer available 
     * if available then calculate fee discount
     * other wise not check 
     *
     * @param string $registrationDate
     * @return int 
     **/
    public function calculateDiscount($registrationDate)
    {
        
    }
}
