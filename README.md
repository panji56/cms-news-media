# 'panji_cms_app'

<p>'panji_cms_app' is a CMS that integrate with the news media website. Create the post then appears as a news (based per category). the CMS app run based on the framework laravel (PHP) and the use of WinterCMS. More about WinterCMS can be seen at the 'About WinterCMS' section. (at the bottom of this README.md)</p>

## for editor (for make post then appear as news in website)

### open then admin website
<p>
  go to 'http://localhost:8000/backend' (or http://[ip_address_website]:[port]/backend where [ip_address_website] and [port] are the ip address of the website and port by asking the admin for those). you will see the page like this
</p>

### login with the password and user that admin provide
<p>
  enter the user and password provide by admin (by default from this app use sqlite database where the user and password are at the 'pass admin.txt' file. if no use sqlite database then ask the admin for the user and password)
</p>

### make the post
<p>
  go to the Blog menu (make sure that you have access to that menu or otherwise ask the admin). you will see there are four menus consists of 'New Post', 'Posts', 'Category', 'Tags'.
</p>

<p>
  on the page you wil see the 'Name', 'Slug', 'Image' and any other parts including the 'Tags' part. To start create the post by fill the Name and the Slug. For the Slug you can use the lowercase letter and replace the space wiht strip '-'. Add the text for the description of your post (this will appear as a mini text under the post or news tittle). Go to the Blocks part and click 'Create'. there are three types you can input: Text, Image, Code. Use Text type to fill the text and then after that click 'Create'. you can make more than one Text, Image or Code Blocks and the Blocks can be sorted to change the order of apperance. after the Blocks part don't forget to add the Category and set the Type to 'Post'. after that click 'Create' or 'Create and Close'.
</p>

## use the 'trending' for trending news and 'breaking' for breaking news

<p>
  by default, the post that you make will always appear at the Latest News section at homepage or Category page. to make appear at the Trending News section and Breaking News section you need to add tag 'Breaking' with slug tag 'breaking' and tag 'Trending' with slug tag 'trending'. The backend process will recognize that tag and appear the post at Trending News section, News Slider at the homepage and Breaking News section. By default from this app if still use sqlite database the tags is available at the Tags section in Blog menu otherwise you need to create those tags.
</p>

### create the tags

<p>
  in the Blog Menu go to the Tags section, click the 'Tag 1', and change the name to 'Trending' and slug to 'trending'. Proceed to go click the Tags section and then 'Tag 2'. Change the 'Tag 2' name to 'Breaking and slug to 'breaking.
</p>

### use the tags

<p>
  go to the Posts at the blog menu, click 'Create', still use the same steps before to make a new post, then go to Tags part and click 'Create'. choose the 'Trending' tag if you want to make it appear at the trending news or 'Breaking' tag if you want to make it appear at the breaking news section. after that click 'Create'. Refresh the website homepage and now you will see the news at the trending news section.
</p>

<p>
  the maximum news or posts that can be appear on trending news section is 5 and breaking news section is 4 sorted by the creation date of the post or news. You can edit the posts by click on of the post and add the tag.
</p>

## for the admin

<p>
  the admin has a lot of access and of them is to create the user for the news editor to make news or post. The admin can study the basics first (including how to deploy this app) by go to the WinterCMS docs.
</p>

### deploy the website (windows)

# About WinterCMS

<p align="center">
    <img src="https://github.com/wintercms/winter/raw/develop/.github/assets/Github%20Banner.png?raw=true" alt="Winter CMS Logo" width="100%" />
</p>

[Winter](https://wintercms.com) is a free, open-source content management system based on the [Laravel](https://laravel.com) PHP framework. Developers and agencies all around the world rely upon Winter for its quick prototyping and development, safe and secure codebase and dedication to simplicity.

No matter how large or small your project is, Winter provides a rich development environment, regardless of your level of experience.

[![Version](https://img.shields.io/github/v/release/wintercms/winter?sort=semver&style=flat-square)](https://github.com/wintercms/winter/releases)
[![Tests](https://img.shields.io/github/workflow/status/wintercms/winter/Tests/develop?label=tests&style=flat-square)](https://github.com/wintercms/winter/actions)
[![License](https://img.shields.io/github/license/wintercms/winter?label=open%20source&style=flat-square)](https://packagist.org/packages/wintercms/winter)
[![Discord](https://img.shields.io/discord/816852513684193281?label=discord&style=flat-square)](https://discord.gg/D5MFSPH6Ux)

[![Open in Gitpod](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#https://github.com/wintercms/winter)

## Installing Winter

Winter can be installed in several ways for both new users and experienced developers - see our [Installation page](https://wintercms.com/install) for more information.

### Quick start with Composer

For advanced users, run the following command in your terminal to install Winter via Composer:

```shell
composer create-project wintercms/winter example.com "dev-develop"
```

Run the following command with the folder created by the previous command to generate an environment file which will contain your configuration settings:

```shell
php artisan winter:env
```

After configuring your installation, you can run the following command to run the database migrations and automatically create an administrator account with the username `admin`. The password of this account will be automatically generated and displayed in your terminal.

```shell
php artisan winter:up
```

## Learning Winter

The best place to learn Winter is by [reading the documentation](https://wintercms.com/docs) or [following some tutorials](https://wintercms.com/blog/category/tutorials). You can also join the maintenance team and our active community on [Discord](https://discord.gg/D5MFSPH6Ux) who are always willing to help out with questions.

## Development team

Winter was forked from October CMS in March 2021 due to a difference in open source management philosophies between the core maintainer team and the two founders of October.

The development of Winter is lead by [Luke Towers](https://luketowers.ca/), along with many wonderful people that dedicate their time to help support and grow the community.

<table>
  <tr>
    <td align="center"><a href="https://github.com/luketowers"><img src="https://avatars.githubusercontent.com/u/7253840?v=3" width="100px;" alt="Luke Towers"/><br /><sub><b>Luke Towers</b></sub></a></td>
    <td align="center"><a href="https://github.com/bennothommo"><img src="https://avatars.githubusercontent.com/u/15900351?v=3" width="100px;" alt="Ben Thomson"/><br /><sub><b>Ben Thomson</b></sub></a></td>
    <td align="center"><a href="https://github.com/mjauvin"><img src="https://avatars.githubusercontent.com/u/2013630?v=3" width="100px;" alt="Marc Jauvin"/><br /><sub><b>Marc Jauvin</b></sub></a></td>
    <td align="center"><a href="https://github.com/jaxwilko"><img src="https://avatars.githubusercontent.com/u/31214002?v=4" width="100px;" alt="Jack Wilkinson"/><br /><sub><b>Jack Wilkinson</b></sub></a></td>
  </tr>
</table>

## Foundation library

Winter is built on top of the wildly-popular [Laravel](https://laravel.com) framework for PHP, with the in-house [Storm](https://github.com/wintercms/storm) library as a buffer between the Laravel framework and the Winter project, to minimize breaking changes and improve stability.

## Getting in touch

You can get in touch with the maintainer team using the following mediums:

* [Follow us on Twitter](https://twitter.com/usewintercms) for announcements and updates.
* [Join us on Discord](https://discord.gg/D5MFSPH6Ux) to chat with us.

## Contributing

Before contributing issues or pull requests, be sure to review the [Contributing Guidelines](https://github.com/wintercms/.github/blob/master/CONTRIBUTING.md) first.

### Coding standards

Please follow the following guides and code standards:

* [PSR 4 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
* [PSR 2 Coding Style Guide](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
* [PSR 1 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)

### Code of conduct

In order to ensure that the Winter community is welcoming to all, please review and abide by the [Code of Conduct](https://github.com/wintercms/.github/blob/master/CODE_OF_CONDUCT.md).

## Sponsors

Winter CMS development is financially supported by the generosity of the following sponsors:

### Organizations

[![Spatial Media logo](https://cdn.ca.spatialmedia.io/media/images/sm-logo-dark-full.svg)](https://spatialmedia.io)
Spatial Media employs two of the core contributors (Luke Towers & Jack Wilkinson) and contributes to the ongoing development of Winter.

[![Froala logo](https://froala.com/wp-content/uploads/2019/10/froala.svg)](https://froala.com/wysiwyg-editor/)

Froala provides a perpetual, Enterprise license to Winter CMS which allows us and our users to use the Froala WYSIWYG Editor in Winter CMS powered projects.

### Individuals
- Orville

If you would like to have your name, company and link added to this list and support open-source development, feel free to make a donation to our [Open Collective](https://opencollective.com/wintercms).

## License

The Winter platform is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Security vulnerabilities

Please review [our security policy](https://github.com/wintercms/winter/security/policy) on how to report security vulnerabilities.
