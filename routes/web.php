<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(route('home'));
    } else {
        return view('index');
    }
})->name('default');

Route::get('/user/error', function () {
    return view('user.error');
});

Auth::routes();
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

Route::get('/home', 'HomeController@index')->name('home');

/* Profile */
Route::post('user/profile/update', 'UserController@store')->name('profile.store');
Route::get('/profile', 'UserController@index')->name('profile');
Route::get('user/profile/update', 'UserController@update')->name('profile.update');
/* Profile */

/* Dependents */
Route::get('user/dependents', 'DependentController@view')->name('dependents');
Route::get('user/dependent/add', 'DependentController@create')->name('dependent.add');
Route::get('user/dependent/edit/id={id}', 'DependentController@edit')->name('dependent.edit');
Route::post('user/dependent/add', 'DependentController@store')->name('dependent.store');
Route::post('user/dependent/edit', 'DependentController@storeEdited')->name('dependent.store.edited');
Route::get('user/dependent/delete/id={id}', 'DependentController@delete')->name('dependent.delete');
/* Dependents */

/* Events */
Route::get('/event/view/id={id}', 'EventController@view')->name('event.view');
Route::post('/event/subscribe/id={id}', 'EventController@subscribe')->name('event.subscribe');
Route::get('/event/subscribe/id={id}', 'EventController@subscribe')->name('event.subscribe');
Route::get('/event/unsubscribe/id={id}', 'EventController@unsubscribe')->name('event.unsubscribe');
Route::post('/event/subscription/id={id}', 'EventController@subscription')->name('event.subscription');
Route::post('/event/checkout/id={event_id}', 'EventController@getCheckout')->name('event.checkout');
Route::get('/event/checkout/completed/{event_id}', 'EventController@getDone')->name('checkout.completed');
Route::get('/event/checkout/canceled/{event_id}', 'EventController@getCancel')->name('checkout.canceled');
Route::get('/events', 'EventController@viewAll')->name('events');
Route::post('/events/search', 'EventController@search')->name('events.search');
Route::post('/events/sort', 'EventController@sort')->name('events.sort');
/* Events */

/* Admin */
Route::get('/admin/user/create', 'AdminController@createAccount')->name('admin.account.create');
Route::post('/admin/user/store', 'AdminController@storeAccount')->name('admin.account.store');
Route::get('/admin/payment/details', 'AdminController@paymentDetails')->name('admin.payment');
Route::post('/admin/payment/details', 'AdminController@getPaymentDetails')->name('admin.payment.details');
Route::post('/admin/event/store', 'AdminController@storeEvent')->name('event.store');
Route::post('/admin/event/registration/store', 'AdminController@storeRegistrationEvent')->name('registration.event.store');
Route::get('/admin/event/create', 'AdminController@createEvent')->name('event.create');
Route::get('/admin/event/registration/create', 'AdminController@createRegistrationEvent')->name('registration.event.create');
Route::get('/admin/mange/event/{id}', 'AdminController@editEvent')->name('event.edit');
Route::post('/admin/mange/event', 'AdminController@saveEvent')->name('event.save');
Route::get('/admin/event/delete/id={id}', 'AdminController@deleteEvent')->name('event.delete');
Route::get('/admin/events/manage', 'AdminController@manageEvents')->name('admin.manage.events');
Route::get('/admin/events/manage/id={event_id}', 'AdminController@eventManage')->name('admin.manage.event');
Route::get('/admin/users/manage', 'AdminController@manageUsers')->name('admin.manage.users');
Route::get('/admin/users/manage/userid={user_id}', 'AdminController@manageUser')->name('admin.manage.user');
/* Admin */

/* Registration Events */
Route::get('/event/register/{id}', 'RegEventController@eventRegistration')->name('registation.event.register');
Route::post('/event/payment/{id}', 'RegEventController@registrationEventPayFees')->name('registration.event.payment');
Route::post('/event/checkout/{id}', 'RegEventController@getCheckout')->name('registration.event.checkout');
Route::get('/event/checkout/completed/{event_id}', 'RegEventController@getDone')->name('registration.checkout.completed');
Route::get('/event/checkout/canceled/{event_id}', 'RegEventController@getCancel')->name('registration.checkout.canceled');
/* Registration Events */