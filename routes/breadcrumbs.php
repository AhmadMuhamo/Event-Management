<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

// Profile
Breadcrumbs::register('profile', function($breadcrumbs)
{
    $breadcrumbs->push('Profile', route('profile'));
});

// Profile > Edit
Breadcrumbs::register('edit', function($breadcrumbs)
{
    $breadcrumbs->parent('profile');
    $breadcrumbs->push('Edit', route('profile.update'));
});

// Dependents
Breadcrumbs::register('dependents', function($breadcrumbs)
{
    $breadcrumbs->push('Dependents', route('dependents'));
});

// Dependents > Add
Breadcrumbs::register('dependent.add', function($breadcrumbs)
{
    $breadcrumbs->parent('dependents');
    $breadcrumbs->push('Add', route('dependent.add'));
});

// Dependents > Edit
Breadcrumbs::register('dependent.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('dependents');
    $breadcrumbs->push('Edit', route('dependents'));
});

//Events
Breadcrumbs::register('events', function($breadcrumbs)
{
    $breadcrumbs->push('Events', route('events'));
});

// Events > Event Name
Breadcrumbs::register('event', function($breadcrumbs, $event) {
    $breadcrumbs->parent('events');
    $breadcrumbs->push($event->event_name, route('event.view', $event->id));
});

// Events > Event Name > Subscription
Breadcrumbs::register('subscription', function($breadcrumbs, $event) {
    $breadcrumbs->parent('event',$event);
    $breadcrumbs->push('Subscription', route('event.subscribe', $event->id));
});

// Events > Event Name > Subscription > Checkout
Breadcrumbs::register('checkout', function($breadcrumbs, $event) {
    $breadcrumbs->parent('subscription',$event);
    $breadcrumbs->push('Checkout', route('event.checkout', $event->id));
});

// Events > Event Name > Subscription > Payment Status
Breadcrumbs::register('payment_status', function($breadcrumbs, $event) {
    $breadcrumbs->parent('subscription',$event);
    $breadcrumbs->push('Payment Status', url('#'));
});


// Profile
Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->push('Admin', url('#'));
});

// Admin > Create Account
Breadcrumbs::register('create_account', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Create Account', url('#'));
});

// Admin > Create Event
Breadcrumbs::register('create_event', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Create Event', url('#'));
});

// Admin > Payment Details
Breadcrumbs::register('payment', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Payment Details', route('admin.payment'));
});

// Admin > Payment Details > Payment ID
Breadcrumbs::register('payment_details', function($breadcrumbs, $payment_id) {
    $breadcrumbs->parent('payment');
    $breadcrumbs->push($payment_id, url('#'));
});

// Admin > Manage Events
Breadcrumbs::register('manage_events', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Manage Events', route('admin.manage.events'));
});

// Admin > Manage Events > Event Name
Breadcrumbs::register('manage_event', function($breadcrumbs, $event) {
    $breadcrumbs->parent('manage_events',$event);
    $breadcrumbs->push($event->event_name, route('admin.manage.event',$event->id));
});

// Admin > Manage Users
Breadcrumbs::register('manage_accounts', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Manage Accounts', route('admin.manage.users'));
});

// Admin > Manage Users > User Email
Breadcrumbs::register('manage_user', function($breadcrumbs, $user) {
    $breadcrumbs->parent('manage_accounts');
    $breadcrumbs->push($user->email, route('admin.manage.user',$user->id));
});


// Events > Event_Name > Edit
Breadcrumbs::register('edit_event', function($breadcrumbs, $event) {
    $breadcrumbs->parent('event',$event);
    $breadcrumbs->push('Edit', route('event.edit', $event->id));
});