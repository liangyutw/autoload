<?php
namespace app\Constants;

class NoticeConstant
{
    public $content = [];
    public function __construct()
    {
        $this->content = [
            "title"     => '每月8日附件月報提醒',
            "content"   => '請記得在8日前的日報，附上個月的月報',
        ];
    }
}
