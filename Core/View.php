<?php

namespace Core;

/**
 * Used to include view component included in ../App/Views/ folder
 */
class View
{

    /**
     * Render a view file.
     * Used with
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     * @return void
     */
    public static function render($view, $args = []){
        extract($args, EXTR_SKIP);
        $file = "../App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found.");
        }
    }
}
