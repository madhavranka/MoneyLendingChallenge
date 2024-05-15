<?php

class Response
{
    public static function echoResponse($result)
    {
        if (is_string($result)) {
            echo $result;
        } else {
            echo json_encode($result);
        }
        die();
    }
}