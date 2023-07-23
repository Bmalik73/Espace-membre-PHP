<?php

function generationToken($length) {
    $alphaNum = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle(str_repeat($alphaNum, $length)), 0, $length);
}
