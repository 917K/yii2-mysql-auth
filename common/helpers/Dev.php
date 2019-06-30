<?php

namespace common\helpers;

/**
 * здесь лежат всякие полезные функции для разработки
 */
class Dev
{

    /**
     * @desc печатаем var_dump красиво для любого
     * числа аргументов
     * @param mixed $params
     */
    public static function exp(...$params) {
        $backtrace = debug_backtrace(2, 1);
        foreach ($params as $param) {
            highlight_string("<?php\n" . $backtrace[0]['file'] . ':' . $backtrace[0]['line'] . ":\n" . var_export($param, true) . ";\n?>");
        }
    }
}