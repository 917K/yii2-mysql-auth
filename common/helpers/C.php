<?php

namespace common\helpers;

/**
 * C helper implements helpers to work with methods of class
 */
class C
{
    private static $tokenConstants = array();

    /**
     * Get all given class constants filtered by token pattern
     * @param string $objectClass class path where to find constants
     * @param string $token keyword to filter constants
     * @param bool $isIncludeToken whether include token in constant name or not
     * @param bool $isReplaceUnderscores whether replace underscores by spaces or not
     * @return array
     */
    public static function getConstants($objectClass, $token = '', $isIncludeToken = false, $isReplaceUnderscores = true) {
        if (!isset(self::$tokenConstants[$objectClass][$token])) {
            $tokenLen = strlen($token);

            $reflection = new \ReflectionClass($objectClass);
            $allConstants = $reflection->getConstants();
//\common\helpers\Dev::exp($objectClass, $allConstants);
            $tokenConstants = array();
            foreach ($allConstants as $name => $val) {
                if (substr($name, 0, $tokenLen) != $token) continue;
                $constName = $name;
                if (!$isIncludeToken) {
                    $constName = substr($constName, $tokenLen - 1);
                }
                if ($isReplaceUnderscores) {
                    $constName = str_replace('_', ' ', $constName);
                }
                $tokenConstants[$val] = trim(ucwords(strtolower($constName)));
            }
            self::$tokenConstants[$objectClass][$token] = $tokenConstants;
        }
//\common\helpers\Dev::exp(self::$tokenConstants);
        return self::$tokenConstants[$objectClass][$token];
    }

    /**
     * Get all given class constants filtered by token pattern
     * @param string $objectClass class path where to find constants
     * @param mixed $value value to find proper constant
     * @param string $token keyword to filter constants
     * @param bool $isIncludeToken whether include token in constant name or not
     * @param bool $isReplaceUnderscores whether replace underscores by spaces or not
     */
    public static function getConstantNameByValue($objectClass, $value, $token = '', $isIncludeToken = false, $isReplaceUnderscores = true) {
        $constants = self::getConstants($objectClass, $token, $isIncludeToken, $isReplaceUnderscores);
        return isset($constants[$objectClass][$value]) ? $constants[$objectClass][$value] : null;
    }

    /**
     * Get all given class constants filtered by token pattern
     * @param string $objectClass class path where to find constants
     * @param mixed $value value to find proper constant
     * @param string $token keyword to filter constants
     */
    public static function getConstantsByPrefix($objectClass, $token = '') {
        $constants = self::getConstants($objectClass, $token);
        return !empty($constants) ? $constants : [];
    }
}