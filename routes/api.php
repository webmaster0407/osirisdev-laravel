<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Prevs
    Route::post('prevs/media', 'PrevsApiController@storeMedia')->name('prevs.storeMedia');
    Route::apiResource('prevs', 'PrevsApiController');

    // Notes
    Route::apiResource('notes', 'NotesApiController');

    // Locations
    Route::post('locations/media', 'LocationsApiController@storeMedia')->name('locations.storeMedia');
    Route::apiResource('locations', 'LocationsApiController');

    // Competences
    Route::apiResource('competences', 'CompetencesApiController');

    // Competenceregistrations
    Route::apiResource('competenceregistrations', 'CompetenceregistrationsApiController');

    // Prevregistrations
    Route::apiResource('prevregistrations', 'PrevregistrationsApiController');

    // Resources
    Route::apiResource('resources', 'ResourcesApiController');

    // Tasks
    Route::apiResource('tasks', 'TasksApiController');

    // Events
    Route::post('events/media', 'EventsApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventsApiController');

    // Eventregistrations
    Route::apiResource('eventregistrations', 'EventregistrationsApiController');

    // Incidents
    Route::post('incidents/media', 'IncidentsApiController@storeMedia')->name('incidents.storeMedia');
    Route::apiResource('incidents', 'IncidentsApiController');

    // Comlog
    Route::apiResource('comlogs', 'ComlogApiController');
});
