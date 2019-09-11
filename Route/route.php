<?php
/** method GET */
$this->router->get('/', function () {
    header('location:index2.php');
});
$this->router->get('/report/notice', 'NoticeController@schedule');

/** method POST */
$this->router->post('/login', 'User\UserController@login');