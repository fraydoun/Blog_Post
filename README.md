# blog_post
#

usage:

1
composer require fraidoon/blog

2
composer require pishran/laravel-persian-slug

3
 composer require morilog/jalali:3.*

4
php artisan storage:link

5
copy this folder to your public directory

C:\xampp\htdocs\YourAppName\vendor\fraidoon\blog\vendor

## http://127.0.0.1:8000/admin/category     ->name('category');
## http://127.0.0.1:8000/admin/post         ->name('post');
## http://127.0.0.1:8000/admin/comment      ->name('comment');



Ignor these
php artisan vendor:publish --tag=laravel-assets --ansi --force
php artisan vendor:publish --provider="Fraidoon\blog\BlogServiceProvider"
