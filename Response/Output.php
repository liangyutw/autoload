<?php
namespace Response;

class Output
{
    public static function toJson(array $data) : string
    {
        return json_encode($data);
    }

    public static function toArray($data)
    {
        return $data;
    }
}
