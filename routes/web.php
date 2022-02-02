<?php



Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

// Impersonate
Route::impersonate();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {



    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Prevs
    Route::delete('prevs/destroy', 'PrevsController@massDestroy')->name('prevs.massDestroy');
    Route::post('prevs/media', 'PrevsController@storeMedia')->name('prevs.storeMedia');
    Route::post('prevs/ckmedia', 'PrevsController@storeCKEditorImages')->name('prevs.storeCKEditorImages');
    Route::resource('prevs', 'PrevsController');

    // Notes
    Route::delete('notes/destroy', 'NotesController@massDestroy')->name('notes.massDestroy');
    Route::resource('notes', 'NotesController');

    // Locations
    Route::delete('locations/destroy', 'LocationsController@massDestroy')->name('locations.massDestroy');
    Route::post('locations/media', 'LocationsController@storeMedia')->name('locations.storeMedia');
    Route::post('locations/ckmedia', 'LocationsController@storeCKEditorImages')->name('locations.storeCKEditorImages');
    Route::resource('locations', 'LocationsController');

    // Competences
    Route::delete('competences/destroy', 'CompetencesController@massDestroy')->name('competences.massDestroy');
    Route::resource('competences', 'CompetencesController');

    // Competenceregistrations
    Route::delete('competenceregistrations/destroy', 'CompetenceregistrationsController@massDestroy')->name('competenceregistrations.massDestroy');
    Route::resource('competenceregistrations', 'CompetenceregistrationsController');

    // Prevregistrations
    Route::delete('prevregistrations/destroy', 'PrevregistrationsController@massDestroy')->name('prevregistrations.massDestroy');
    Route::resource('prevregistrations', 'PrevregistrationsController');

    // Resources
    Route::delete('resources/destroy', 'ResourcesController@massDestroy')->name('resources.massDestroy');
    Route::resource('resources', 'ResourcesController');

    // Tasks
    Route::delete('tasks/destroy', 'TasksController@massDestroy')->name('tasks.massDestroy');
    Route::resource('tasks', 'TasksController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Eventregistrations
    Route::delete('eventregistrations/destroy', 'EventregistrationsController@massDestroy')->name('eventregistrations.massDestroy');
    Route::resource('eventregistrations', 'EventregistrationsController');

    // Incidents
    Route::delete('incidents/destroy', 'IncidentsController@massDestroy')->name('incidents.massDestroy');
    Route::post('incidents/media', 'IncidentsController@storeMedia')->name('incidents.storeMedia');
    Route::post('incidents/ckmedia', 'IncidentsController@storeCKEditorImages')->name('incidents.storeCKEditorImages');
    Route::resource('incidents', 'IncidentsController');

    // Comlog
    Route::delete('comlogs/destroy', 'ComlogController@massDestroy')->name('comlogs.massDestroy');
    Route::resource('comlogs', 'ComlogController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
