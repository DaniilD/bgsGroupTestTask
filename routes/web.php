<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//$router->get('/',"MemberController@getAllMember") ;

//Группа роутов для api
$router->group(["prefix"=>"api/v1"], function () use ($router){
    //Роут для получения всех Участников мероприятия
    $router->get("/getAllMember", "MemberController@getAllMember");
    //Роут для получения определенного участника мероприятия
    $router->get("/getMember/{id}", "MemberController@getMember");
    //роут для получения всех участнико  определенного мероприятия
    $router->get("/getFilterMember/{event_id}", "MemberController@getFilterMember");
    //роут для создания нового участника мероприятия
    $router->post("/createMember", "MemberController@createMember");
    //Роут для обновления информации об участнике мероприятия
    $router->put("/updateMember/{id}", "MemberController@updateMember");
    //Роут для удаления участника мероприятия
    $router->delete("/deleteMember/{id}", "MemberController@deleteMember");

});
