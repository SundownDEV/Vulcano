<p align="center"><img src="./docs/logo.png" alt=""></p>

# DaimyoCMS
[![Build Status](https://img.shields.io/travis/SundownDEV/DaimyoCMS.svg?style=flat)](http://travis-ci.org/SundownDEV/DaimyoCMS) ![Source](http://img.shields.io/badge/source-SundownDEV/DaimyoCMS-blue.svg?style=flat) ![Version](https://img.shields.io/badge/version-0.2.1-lightgrey.svg?style=flat) ![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)

DaimyoCMS is an open-source PHP CMS based on the micro framework [Daimyo](https://github.com/SundownDEV/Daimyo) using PHP 7.

## Development
```version 0.2.1 dev|non-stable```

- [x] Templating
  - [x] Default blog template
  - [x] Default admin dashboard template
- [ ] Administration
  - [x] Admin login feature
  - [ ] Manage articles
      - [ ] Markdown editor
  - [x] Manage categories
  - [ ] Manage local files
  - [ ] Image compression
  - [ ] Manage users
  - [ ] User groups feature
  - [ ] General configuration settings
  - [x] User settings
  - [ ] Navigation management
  - [ ] Pages management
  - [ ] Templates management
- [ ] Blog
  - [x] Read articles
  - [ ] Comments
  - [ ] Sign up/in as simple user
  - [ ] Search feature
- [ ] Unit tests

![screenshot dashboard](https://raw.githubusercontent.com/SundownDEV/DaimyoCMS/master/docs/screenshots/dashboard.jpg)

## Features
* Manage content such as users, articles and categories...
* Markdown editor
* Local file management or with an external API
* Easy to customize, add pages, navigation, templates and more
* Make templating easily using Twig
* Lightweight and secure

## Why DaimyoCMS ?
You may ask why should you use this CMS while there's a lot of other popular ones, what makes this CMS better than another one ? Well, nothing. I created DaimyoCMS to handle tiny personal projects and code in my way as a junior developer. If you are looking for lightweight and micro php framework based content management system you're on the right way, DaimyoCMS is just part of my personal R&D. Feel free to give it a review or contribute!

DaimyoCMS is fast, secure and lightweight, but also basic in features.

## Requirement
* PHP >= 7.*
  * php7.*-gd
* MySQL >= 5.6
* Composer

**You need to install (or enable in php.ini) PHP "file info" extension.**

# Documentations
* [Getting started](docs/GetStarted.md)
* [Administration panel](docs/AdminPanel.md)

#### Developers

* [Overview](docs/Overview.md)
* [Routing](docs/Routing.md)
* [Templating](docs/Templating.md)
* [Exploited PDO Class](docs/PDOClass.md)
* [File upload](docs/UploadClass.md)
* [Validator class](docs/ValidatorClass.md)
