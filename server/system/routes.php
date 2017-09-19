<?php

use \RedBeanPHP\R as R;


$app->get('/itos/config', function ($request, $response) {
    $rs = [
        'plugins' => [
            [
                'name' => 'article',
                'commands' => ['edit', 'save', 'delte', 'quit', 'create']
            ],
            [

            ]
        ],
        'defaultPlugin' => 'article',
        'routes' => [
            [
                'path' => '/',
                'redirect' => '/article'
            ],
            [
                'path' => '/install',
                'component' => 'install/InstallContent'
            ],
            [
                'path' => '/article',
                'component' => 'article/MyContent'
            ],
            [
                'path' => '/article/:id/edit',
                'component' => 'article/ArticleEdit'
            ],
            [
                'path' => '/article/:id',
                'component' => 'article/MyPage'
            ],
            [
            'path' => '/article/create',
            'component' => 'article/AtricleCreate'
        ]
        ]
    ];
    $response = $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($rs);
    return $response;
});


$app->get('/itos/install', function ($request, $response) {

});


$app->post('/user/login', function ($request, $response) {
    $session = $this->session;
    $parsedBody = $request->getParsedBody();
    $uname = $parsedBody['uname'];
    $pwd = $parsedBody['pwd'];
    $user  = R::findOne( 'users', 'uname=?', [$uname]);
    if (empty($user)) {
        $response = $response->withJson([
            "error" => 0,
            "msg" => "Account or password error"
        ]);
        return $response;
    }
    if ($user->pwd == $pwd) {
        $response = $response->withJson([
            "error" => 0,
            "msg" => "login success"
        ]);
        return $response;
    } else {
        $response = $response->withJson([
            "error" => 0,
            "msg" => "Account or password error"
        ]);
        return $response;
    }
});