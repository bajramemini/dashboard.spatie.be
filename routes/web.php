<?php

use App\Http\Middleware\AccessToken;

Route::group(['middleware' => AccessToken::class], function () {
    Route::get('/', 'DashboardController');

    Route::post('temperature', 'UpdateTemperatureController');

    Route::post('indoor-air-quality', 'UpdateIndoorAirQualityController');
});

Route::ohDearWebhooks('/oh-dear-webhooks');


Route::get('/api/teamwork/activity', 'TeamworkApiController@activity');
Route::group(['middleware' => ['cache']], function () {
    Route::get('/api/teamwork/milestones', 'TeamworkApiController@milestones');
    Route::get('/api/teamwork/milestone/{id}', 'TeamworkApiController@milestone');
    Route::get('/api/teamwork/projects', 'TeamworkApiController@projects');
    Route::get('/api/teamwork/project/{id}', 'TeamworkApiController@project');
    Route::get('/api/teamwork/columns/{id}', 'TeamworkApiController@boardColumn');

    Route::get('/api/teamwork/projekte/columns', 'TeamworkProjekteController@columns');
    Route::get('/api/teamwork/projekte/board/{slug}', 'TeamworkProjekteController@board');
});