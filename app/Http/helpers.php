<?php

/*
 * This file is for custom helpers functions.
 */

/**
 * show message from session in HTML-file
 */
function message()
{
    if (session()->has('message')) {
        echo '<div class = "text-center">' .
                '<h2>' .
                session('message') .
                '</h2>' .
                '</div>';
    }
}
