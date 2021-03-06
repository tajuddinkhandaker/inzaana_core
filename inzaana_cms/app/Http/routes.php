<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
| --------------------------
| Server deployment routing
| --------------------------
*/

Route::group([ 'as' => 'guest::' ], function() {

    Route::get('/', [ 'uses' => 'HomeController@index', 'as' => 'home' ]);  
    // Subdomain routing
    Route::group(array('domain' => '{name}.inzaana.{domain}'), function() {
        
        Route::get('/showcase', [ 'uses' => 'HomeController@redirectToStore', 'as' => 'showcase' ]); 
    });

}); 

Route::group(['middleware' => 'web'], function () {

    Route::group(['as' => 'admin::'], function () {
        //Stripe Route for Super Admin
        Route::get('/super-admin/create-plan', [ 'uses' => 'StripeController@planForm', 'as'=> 'planForm']);
        Route::post('/super-admin/create-plan', [ 'uses' => 'StripeController@createPlan', 'as'=> 'create.plan']);
        Route::get('/super-admin/view-plan', [ 'uses' => 'StripeController@viewPlan', 'as'=> 'viewPlan']);
        Route::post('/super-admin/delete-plan', [ 'uses' => 'StripeController@deletePlan', 'as'=> 'deletePlan']);
        Route::post('/super-admin/view-plan/ajax/update', [ 'uses' => 'StripeController@updateStatus', 'as'=> 'updateStatus']);
        Route::get('/super-admin/view-subscriber', [ 'uses' => 'StripeController@viewSubscriber', 'as'=> 'viewSubscriber']);
        Route::get('/super-admin/approvals', [ 'uses' => 'UserController@approvals', 'as'=> 'approvals']);
        Route::get('/super-admin/approvals/manage', [ 'uses' => 'UserController@manageApprovals', 'as'=> 'approvals.manage']);
    });
    Route::auth();


    // Routing grouped by namespace
    Route::group(['namespace' => 'Auth'], function() {

        Route::group([ 'as' => 'guest::' ], function() {

            Route::get('/register/confirm/{token}/site/{site}/store/{store}', [ 'uses' => 'AuthController@confirmEmail', 'as' => 'register.confirm.vendor' ]);
            Route::get('/register/confirm/{token}', [ 'uses' => 'AuthController@confirmEmailCustomer', 'as' => 'register.confirm.customer' ]);
            Route::get('/signup', [ 'uses' => 'AuthController@showSignupForm', 'as' => 'signup' ]);

            // TODO: routes for way to register from different user like: super admin/ vendor/ customer
            Route::get('/signup/customer', [ 'uses' => 'AuthController@redirectToCustomerSignup', 'as' => 'signup.customer' ]);
            Route::get('/signup/admin', [ 'uses' => 'AuthController@mailToAdminForSpecialSignup', 'as' => 'signup.mailto.admin' ]);
            Route::get('/signup/admin/t/{token}/o/{original}', [ 'uses' => 'AuthController@redirectToAdminSignup', 'as' => 'signup.admin' ]);
        }); 
    });

    Route::group([ 'as' => 'user::' ], function() {

        // Store controller
        Route::group(['prefix' => 'stores'], function () {

            Route::get('/', [ 'uses' => 'StoreController@index', 'as' => 'stores' ]);           
            Route::get('/redirect/site/{site}', [ 'uses' => 'StoreController@redirectUrl', 'as' => 'stores.redirect' ]);           
            Route::get('/create/name/{name}/site/{site}', [ 'uses' => 'StoreController@createOnSignUp', 'as' => 'stores.create-on-signup' ]);           
            Route::post('/create', [ 'uses' => 'StoreController@create', 'as' => 'stores.create' ]);           
            Route::post('/{store}', [ 'uses' => 'StoreController@postUpdate', 'as' => 'stores.update' ]);           
            Route::get('/{store}/edit/', [ 'uses' => 'StoreController@update', 'as' => 'stores.edit' ]);           
            Route::post('/{store}/delete/', [ 'uses' => 'StoreController@delete', 'as' => 'stores.delete' ]);           
        }); 

        // routes grouped by /dashboard
        Route::group(['prefix' => 'dashboard'], function () {

            // User controller
            Route::get('/', [ 'uses' => 'UserController@index', 'as' => 'home' ]);

            // routes grouped by /vendor
            Route::group(['prefix' => 'vendor'], function () {

                Route::get('/', [ 'uses' => 'UserController@redirectToDashboard', 'as' => 'vendor.dashboard' ]); 
                Route::get('/plan', [ 'uses' => 'UserController@redirectToVendorPlan', 'as' => 'vendor.plan' ]);
                Route::get('/view-my-subscription', [ 'uses' => 'StripeController@viewMySubscription', 'as'=> 'viewMySubscription']);

            });
            Route::get('/admin', [ 'uses' => 'UserController@redirectToDashboardAdmin', 'as' => 'admin.dashboard' ]);
            Route::get('/customer', [ 'uses' => 'UserController@redirectToDashboardCustomer', 'as' => 'customer.dashboard' ]);
            Route::get('/edit/users/{user}', [ 'uses' => 'UserController@edit', 'as' => 'edit' ]);
            Route::post('/update/users/{user}', [ 'uses' => 'UserController@update', 'as' => 'update' ]);
        });

        Route::get('/user_my_order', [ 'uses' => 'UserController@usermyorder', 'as' => 'orders' ]);
        Route::get('/user_product_return', [ 'uses' => 'UserController@userproductreturn', 'as' => 'products.return' ]);
        Route::get('/user_reward_points', [ 'uses' => 'UserController@userrewardpoints', 'as' => 'reward-points' ]);
        Route::get('/user_wallet', [ 'uses' => 'UserController@userwallet', 'as' => 'wallet' ]);
        Route::get('/who-am-i', [ 'uses' => 'UserController@user', 'as' => 'info' ]);

        // Template Controller
        Route::get('/templates/gallery', [ 'uses' => 'TemplateController@index', 'as' => 'templates' ]);
        Route::get('/templates/saved', [ 'uses' => 'TemplateController@showSaved', 'as' => 'templates.saved' ]);
        
        Route::get('/templates/info/{template_id}', [ 'uses' => 'TemplateController@info', 'as' => 'templates.info' ]);
        Route::get('/templates/template/{template_id}', [ 'uses' => 'TemplateController@show', 'as' => 'templates.show' ]);
        Route::get('/templates/category/{category_name}', [ 'uses' => 'TemplateController@categories', 'as' => 'templates.categories.show' ]);

        Route::get('/editor/{category}/{template}', [ 'uses'=>'TemplateController@browse', 'as'=>'templates.editor.browse' ]);
        Route::get('/editor/{category}/{template}/{template_id}', [ 'uses'=>'TemplateController@editor', 'as'=>'templates.editor.edit' ]);

        Route::get('/viewer/{saved_name}/{template_id}', [ 'uses'=>'TemplateController@show', 'as'=>'templates.viewer' ]);

        Route::post('/templates/create', [ 'uses' => 'TemplateController@create', 'as' => 'templates.create' ]);
        Route::post('/templates/edit/{template_id}', [ 'uses' => 'TemplateController@edit', 'as' => 'templates.edit' ]);

        // Product controller
        Route::get('/products', [ 'uses' => 'ProductController@index', 'as' => 'products' ]);
        Route::get('/products/search', [ 'uses' => 'ProductController@search', 'as' => 'products.search' ]);
        Route::get('/products/search/{terms?}', [ 'uses' => 'ProductController@searchTerms', 'as' => 'products.search-terms' ]);
        Route::post('/products/create', [ 'uses' => 'ProductController@create', 'as' => 'products.create' ]);
        Route::post('/products/sell-yours/{id}', [ 'uses' => 'ProductController@copy', 'as' => 'products.sell-yours' ]);
        Route::post('/products/edit/{product_id}', [ 'uses' => 'ProductController@edit', 'as' => 'products.edit' ]);
        Route::post('/products/delete/{product_id}', [ 'uses' => 'ProductController@delete', 'as' => 'products.delete' ]);
        Route::get('/products/approvals', [ 'uses' => 'ProductController@approvals', 'as' => 'products.approvals' ]);

        // Category controller
        Route::get('/categories', [ 'uses' => 'CategoryController@index', 'as' => 'categories' ]);
        Route::post('/categories/create', [ 'uses' => 'CategoryController@create', 'as' => 'categories.create' ]);
        Route::get('/categories/edit/{category_id}', [ 'uses' => 'CategoryController@edit', 'as' => 'categories.edit' ]);
        Route::post('/categories/edit/{category_id}', [ 'uses' => 'CategoryController@postEdit', 'as' => 'categories.update' ]);
        Route::post('/categories/delete/{category_id}', [ 'uses' => 'CategoryController@delete', 'as' => 'categories.delete' ]);
        Route::get('/categories/approvals', [ 'uses' => 'CategoryController@approvals', 'as' => 'categories.approvals' ]);

        // HTML view menu controller
        Route::post('/html-view-menus/{template_id}', [ 'uses' => 'HtmlViewMenuController@contents', 'as' => 'menus.contents' ]);
        Route::post('/html-view-menus/content-default/{template_id}', [ 'uses' => 'HtmlViewMenuController@baseContent', 'as' => 'menus.content.default' ]);
        Route::post('/html-view-menus/create/{template_id}', [ 'uses' => 'HtmlViewMenuController@create', 'as' => 'menus.create' ]);

        // HTML view content controller
        Route::post('/html-view-contents/create', [ 'uses' => 'HtmlViewContentController@create', 'as' => 'html-view-contents.create' ]);

        // Media Archive Controller
        Route::post('/medias/save', [ 'uses' => 'MediaController@save', 'as' => 'medias.save' ]);
        Route::get('/medias/template/{template_id}', [ 'uses' => 'MediaController@reload', 'as' => 'medias.reload' ]);
        Route::get('/medias/images/{filename}', [ 'uses' => 'MediaController@image', 'as' => 'medias.image' ]);

    });
});
