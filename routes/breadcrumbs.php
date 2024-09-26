<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('web.home'));
});

Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('about'));
});

Breadcrumbs::for('resource', function ($trail) {
    $trail->parent('home');
    $trail->push(__('messages.resource'), '#');
});

Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('resource');
    $trail->push(__('messages.blog'), route('blog.home'));
});

Breadcrumbs::for('blog-viewall', function ($trail, $blogcategory=NULL) {
    $trail->parent('blog');
    $trail->push($blogcategory->blogcategorydetails->first()->title??'', route('blog.home',['blog_category_slug' => $blogcategory->slug]));
});

Breadcrumbs::for('blog-detail', function ($trail, $blog) {
    $trail->parent('blog-viewall',$blog->category);
    $trail->push($blog->blogdetails->first()->title??'');
});

Breadcrumbs::for('waterproofing-solution', function ($trail) {
    $trail->parent('home');
    $trail->push(__('messages.waterproofing-solutions'));
});

Breadcrumbs::for('warranty', function ($trail) {
    $trail->parent('home');
    $trail->push(__('messages.warranty'));
});

Breadcrumbs::for('faqs', function ($trail) {
    $trail->parent('resource');
    $trail->push(__('messages.faq'));
});

Breadcrumbs::for('library', function ($trail) {
    $trail->parent('resource');
    $trail->push(__('messages.library'));
});

Breadcrumbs::for('disclaimer', function ($trail) {
    $trail->parent('home');
    $trail->push(__('messages.disclaimer'));
});

Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push(__('messages.contact-us'));
});

