<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Abn implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $abn)
    {
        $abn = str_replace(' ', '', $abn);
 
        if (strlen($abn) !== 11) {
            return false;
        }
         
        $nums = array_map('intval', str_split($abn, 1));
        $nums[0] -= 1;
         
        $weights = [10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19];
         
        foreach($nums as $pos => $num) {
            $weight = $weights[$pos];
            $nums[$pos] = $num * $weight;
        }
         
        return array_sum($nums) % 89 === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid ABN.';
    }
}
