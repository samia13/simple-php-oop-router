<?php
define('BASE_PATH', '/router');

require "vendor/autoload.php";

use App\Router\Route;

// Add the necessary routes 

// Home page 
Route::get('/',function(){
    require 'pages/home.php';
});

// Blog page
Route::get('/posts', function(){
    require 'pages/blog.php';
});

// single post page
Route::get('/posts/([0-9]*)', function($id){
    require 'pages/blog-single.php';
});

// Contact page 
Route::get('/contact', function(){
    require 'pages/contact.php';
});

// Contact form
Route::post('/contact-form', function(){
    echo "Form sent successfully <br />
            Thank you ".$_POST['name'];
});

Route::run(BASE_PATH);
