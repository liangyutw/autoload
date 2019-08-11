<?php
namespace app\Response;

class Output
{
    public static function toJson(array $data) : string
    {
        return json_encode($data);
    }

    public static function toArray(array $data)
    {
        $pre = '<pre>'.print_r($data, true);
        return $pre;
    }
}
