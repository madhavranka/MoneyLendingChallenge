<?php

class Validator
{
    private static function validateIntSpec($spec, $val): array
    {
        if (!is_int(intval($val))) return ['error' => $spec['name']. ' value must be an integer'];
        if (array_key_exists('min-val', $spec) && $val < $spec['min-val']) {
            return ['error' => $spec['name']. ' value too small, should be greater than or equal to '.$spec['min-val']];
        }
        if (array_key_exists('max-val', $spec) && $val > $spec['max-val']) {
            return ['error' => $spec['name']. ' value too large, should be less than or equal to '.$spec['max-val']];
        }
        return ['error' => ''];
    }

    private static function validateStringSpec($spec, $val): array
    {
        if (!is_string($val)) return ['error' => $spec['name'].' value must be a string'];
        if (array_key_exists('regex', $spec) && !preg_match($spec['regex'], $val)) {
            return ['error' => $spec['name'].' value failed regex match'];
        }
        $len = strlen($val);
        if (array_key_exists('max-length', $spec) && $len > $spec['max-length']) {
            return ['error' => $spec['name'].' value too long', 'path' => [], 'val' => $val];
        }
        if (array_key_exists('min-length', $spec) && $len < $spec['min-length']) {
            return ['error' => $spec['name'].' value too short', 'path' => [], 'val' => $val];
        }
        return ['error' => ''];
    }

    private static function validateFnSpec($spec, $val): array
    {
        $args = empty($spec['class']) ? $spec['name'] : [$spec['class'], $spec['name']];
        $result = call_user_func($args,$val,$spec);
        if ($result["error"]!="") {
            return $result;
        }
        return ['error' => ''];
    }

    public function validateSpec($specs, $params){
        $result = ['error' => ''];
        foreach($specs as $name => $spec){
            switch ($spec['type']) {
                case 'fn':
                    $result =  self::validateFnSpec($spec,  $params[$name]);
                    if($result['error']!="")return $result;
                    break;
                case 'string':
                    $result =  self::validateStringSpec($spec, $params[$name]);
                    if($result['error']!="")return $result;
                    break;
                case 'integer':
                    $result =  self::validateIntSpec($spec, $params[$name]);
                    if($result['error']!="")return $result;
                    break;
            }
        }
        return $result;
    }

    public static function validateDateOfBirth(string $dateOfBirth, $specs): array
    {
        $currentTime = new DateTime();
        try {
            $dateOfBirthObject = new DateTime($dateOfBirth);
        }catch (Exception $e) {
            return ['error' => "Invalid date of birth format: ".$e->getTrace()];
        }
        if($dateOfBirthObject >= $currentTime){
            return ['error' => "Date of Birth cannot be in future"];
        }
        return ['error' => ''];
    }

    public static function validateLoanAmount($amount , $specs): array
    {
        if(!is_integer(intval($amount))){
            return ['error' => "Amount must be an integer"];
        }
        if(isset($specs['min-value']) && $amount < $specs['min-value']){
            return ['error' => "Amount must be greater than or equal to ".$specs['min-value']];
        }
        if(isset($specs['max-value']) && $amount > $specs['max-value']){
            return ['error' => "Amount must be less than or equal to".$specs['max-value']];
        }
        if($amount % 10000 != 0){
            return ['error' => "Amount must be a multiple of 10000"];
        }
        return ['error' => ''];
    }
}