Add comments to any page on your site.
![image](https://user-images.githubusercontent.com/904958/209522089-da572948-8d5f-4e01-ab7d-604691f9a85d.png)
![image](https://user-images.githubusercontent.com/904958/209521953-3ae2ab52-b63d-4d80-b33d-7a0a63bf61ed.png)

### Features
* Absolutely free (MIT)
* Support front-end users (see [winter/wn-user-plugin](https://github.com/wintercms/wn-user-plugin))
* Moderation
* Show/hide the email field
* Support for tree comments
* The ability to delete comments
* Email notifications

### Language support
* English
* Russian

### Supported versions
Please check: https://www.php.net/supported-versions.php
* PHP 8.0
* PHP 8.1
* PHP 8.2

### Installation
```bash
composer require dimsog/wn-comments-plugin
```

### How to use
```html
title = "Demonstration"
url = "/post/:slug"
layout = "default"

[comments]

==

{% component 'comments' %}

```

### Show form only for authenticated users
<strong>Important!</strong>
You must install a frontend-end user plugin! For example [winter/wn-user-plugin](https://github.com/wintercms/wn-user-plugin)
```bash
composer require wintercms/wn-user-plugin
```
```html
title = "Demonstration"
url = "/post/:slug"
layout = "default"

[comments]
auth = true

==

{% component 'comments' %}

```

### Show comments for specific page
```html
title = "Demonstration"
url = "/post/:slug"
layout = "default"

[comments]
url = "{{ :slug }}"

==

{% component 'comments' %}
```


### Count the total number of comments from current page
```html
Count: <span id="comments-count">{{ comments.count() }}</span>
```

### Count the total number of comments from another page
```html
Count: <span id="comments-count">{{ comments.count('/') }}</span>
```


### Configuration
![image](https://user-images.githubusercontent.com/904958/211208685-4f0603da-1bef-4fba-9791-f25460b3a2da.png)