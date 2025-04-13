<?php
if (!function_exists('e')) {
    /**
     * Encode une chaîne de caractères en HTML.
     *
     * @param string $string
     * @return string
     */
    function e($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
?>
