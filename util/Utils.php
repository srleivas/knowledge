<?php

function dump(mixed $arg, bool $showKeys = true)
{
    if (is_string($arg)) {
        echo "<pre>";
        var_export($arg);
        echo "</pre>";
    }

    if (is_array($arg)) {

        foreach ($arg as $key => $val) {

            if ($showKeys) {
                echo "<pre>";
                var_export($key);
                echo "</pre>";
            }

            echo "<pre onclick='collapse_js(event)'>";
            var_export($val);
            echo "</pre>";
        }
    }
}
