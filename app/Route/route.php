<?php

$this->router->get('/', function () {
    return 'Hello world';
});

$this->router->get('/test', 'TestController@index');

// $this->router->post('/data', function ($request) {
//     return json_encode($request->getBody());
// });
