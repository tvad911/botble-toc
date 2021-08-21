# Overview
This is a plugin for Botble CMS so you have to purchase Botble CMS first to use this plugin.
 
The "Table of content" plugins is an expanded version of 
https://github.com/nivianh/toc

![alt text](https://github.com/tvad911/botble-toc/blob/master/documents/images/01.jpeg?raw=true)
![alt text](https://github.com/tvad911/botble-toc/blob/master/documents/images/02.jpeg?raw=true)

# Installation

- Rename folder `botble-toc-master` to `toc`.
- Copy folder `toc` into `/platform/plugins`.
- Go to Admin Panel -> Plugins and activate plugin Table of content.


# Config
- Go to Admin Panel -> Theme options:
+ Table of content, set your config.
![alt text](https://github.com/tvad911/botble-toc/blob/master/documents/images/03.jpeg?raw=true)

Please "Enable Toc" before using it.

# Using
1. Using config: On `config\general.php`
 
```php
	'supported' => [
        'Botble\Blog\Models\Post',
    ],
```
Register your model to show TOC.

2. Using shortcode
Add `[toc][/toc]` on your content to show TOC, at this point.

![alt text](https://github.com/tvad911/botble-toc/blob/master/documents/images/04.jpeg?raw=true)

Add `[no-toc][/no-toc]` to remove all TOC content when using config or shortcode.

![alt text](https://github.com/tvad911/botble-toc/blob/master/documents/images/05.jpeg?raw=true)

# Contact us
- Email: facebook.com/anhduongphuong

