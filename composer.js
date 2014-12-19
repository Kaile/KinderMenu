({
  "_readme": ["This file locks the dependencies of your project to a known state", "Read more about it at http://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file", "This file is @generated automatically"],
  "hash": "865ce4d9e6c2c445e707b268f070dd3f",
  "packages": [
    {
      "name": "bower-asset/bootstrap",
      "version": "v3.3.1",
      "source": {
        "type": "git",
        "url": "https://github.com/twbs/bootstrap.git",
        "reference": "9a7e365c2c4360335d25246dac11afb1f577210a"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/twbs/bootstrap/zipball/9a7e365c2c4360335d25246dac11afb1f577210a",
        "reference": "9a7e365c2c4360335d25246dac11afb1f577210a",
        "shasum": ""
      },
      "require": {
        "bower-asset/jquery": ">=1.9.1"
      },
      "type": "bower-asset-library",
      "extra": {
        "bower-asset-main": ["less/bootstrap.less", "dist/css/bootstrap.css", "dist/js/bootstrap.js", "dist/fonts/glyphicons-halflings-regular.eot", "dist/fonts/glyphicons-halflings-regular.svg", "dist/fonts/glyphicons-halflings-regular.ttf", "dist/fonts/glyphicons-halflings-regular.woff"],
        "bower-asset-ignore": ["/.*", "_config.yml", "CNAME", "composer.json", "CONTRIBUTING.md", "docs", "js/tests", "test-infra"]
      },
      "description": "The most popular front-end framework for developing responsive, mobile first projects on the web.",
      "keywords": ["css", "framework", "front-end", "js", "less", "mobile-first", "responsive", "web"]
    }, {
      "name": "bower-asset/jquery",
      "version": "2.1.2",
      "source": {
        "type": "git",
        "url": "https://github.com/jquery/jquery.git",
        "reference": "a04f5ff9795fd6292117563623db44cf3f875868"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/jquery/jquery/zipball/a04f5ff9795fd6292117563623db44cf3f875868",
        "reference": "a04f5ff9795fd6292117563623db44cf3f875868",
        "shasum": ""
      },
      "require-dev": {
        "bower-asset/qunit": "1.14.0",
        "bower-asset/requirejs": "2.1.10",
        "bower-asset/sinon": "1.8.1",
        "bower-asset/sizzle": "2.1.1-patch2"
      },
      "type": "bower-asset-library",
      "extra": {
        "bower-asset-main": "dist/jquery.js",
        "bower-asset-ignore": ["**/.*", "build", "speed", "test", "*.md", "AUTHORS.txt", "Gruntfile.js", "package.json"]
      },
      "license": ["MIT"],
      "keywords": ["javascript", "jquery", "library"]
    }, {
      "name": "bower-asset/jquery.inputmask",
      "version": "3.1.48",
      "source": {
        "type": "git",
        "url": "https://github.com/RobinHerbots/jquery.inputmask.git",
        "reference": "d9ebcf6ce4be6bd8642a10c633fe950c0c0f0a9d"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/RobinHerbots/jquery.inputmask/zipball/d9ebcf6ce4be6bd8642a10c633fe950c0c0f0a9d",
        "reference": "d9ebcf6ce4be6bd8642a10c633fe950c0c0f0a9d",
        "shasum": ""
      },
      "require": {
        "bower-asset/jquery": ">=1.7"
      },
      "type": "bower-asset-library",
      "extra": {
        "bower-asset-main": ["./dist/inputmask/jquery.inputmask.js", "./dist/inputmask/jquery.inputmask.extensions.js", "./dist/inputmask/jquery.inputmask.date.extensions.js", "./dist/inputmask/jquery.inputmask.numeric.extensions.js", "./dist/inputmask/jquery.inputmask.phone.extensions.js", "./dist/inputmask/jquery.inputmask.regex.extensions.js"],
        "bower-asset-ignore": ["**/.*", "qunit/", "nuget/", "tools/", "js/", "*.md", "build.properties", "build.xml", "jquery.inputmask.jquery.json"]
      },
      "license": ["http://opensource.org/licenses/mit-license.php"],
      "description": "jquery.inputmask is a jquery plugin which create an input mask.",
      "keywords": ["form", "input", "inputmask", "jQuery", "mask", "plugins"]
    }, {
      "name": "bower-asset/punycode",
      "version": "v1.3.2",
      "source": {
        "type": "git",
        "url": "https://github.com/bestiejs/punycode.js.git",
        "reference": "38c8d3131a82567bfef18da09f7f4db68c84f8a3"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/bestiejs/punycode.js/zipball/38c8d3131a82567bfef18da09f7f4db68c84f8a3",
        "reference": "38c8d3131a82567bfef18da09f7f4db68c84f8a3",
        "shasum": ""
      },
      "type": "bower-asset-library",
      "extra": {
        "bower-asset-main": "punycode.js",
        "bower-asset-ignore": ["coverage", "tests", ".*", "component.json", "Gruntfile.js", "node_modules", "package.json"]
      }
    }, {
      "name": "bower-asset/yii2-pjax",
      "version": "v2.0.2",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/jquery-pjax.git",
        "reference": "fb92be865c0fd6583714475cb7d629020749d73f"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/jquery-pjax/zipball/fb92be865c0fd6583714475cb7d629020749d73f",
        "reference": "fb92be865c0fd6583714475cb7d629020749d73f",
        "shasum": ""
      },
      "require": {
        "bower-asset/jquery": ">=1.8"
      },
      "type": "bower-asset-library",
      "extra": {
        "bower-asset-main": "./jquery.pjax.js",
        "bower-asset-ignore": [".travis.yml", "Gemfile", "Gemfile.lock", "vendor/", "script/", "test/"]
      }
    }, {
      "name": "cebe/markdown",
      "version": "1.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/cebe/markdown.git",
        "reference": "9d6c36d6623497523ed421a31d940bc1d7435578"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/cebe/markdown/zipball/9d6c36d6623497523ed421a31d940bc1d7435578",
        "reference": "9d6c36d6623497523ed421a31d940bc1d7435578",
        "shasum": ""
      },
      "require": {
        "lib-pcre": "*",
        "php": ">=5.4.0"
      },
      "require-dev": {
        "cebe/indent": "*",
        "facebook/xhprof": "*@dev",
        "phpunit/phpunit": "3.7.*"
      },
      "bin": ["bin/markdown"],
      "type": "library",
      "extra": {
        "branch-alias": {
          "dev-master": "1.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "cebe\\markdown\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["MIT"],
      "authors": [
        {
          "name": "Carsten Brandt",
          "email": "mail@cebe.cc",
          "homepage": "http://cebe.cc/",
          "role": "Creator"
        }
      ],
      "description": "A super fast, highly extensible markdown parser for PHP",
      "homepage": "https://github.com/cebe/markdown#readme",
      "keywords": ["extensible", "fast", "gfm", "markdown", "markdown-extra"],
      "time": "2014-10-25 16:16:49"
    }, {
      "name": "ezyang/htmlpurifier",
      "version": "v4.6.0",
      "source": {
        "type": "git",
        "url": "https://github.com/ezyang/htmlpurifier.git",
        "reference": "6f389f0f25b90d0b495308efcfa073981177f0fd"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/ezyang/htmlpurifier/zipball/6f389f0f25b90d0b495308efcfa073981177f0fd",
        "reference": "6f389f0f25b90d0b495308efcfa073981177f0fd",
        "shasum": ""
      },
      "require": {
        "php": ">=5.2"
      },
      "type": "library",
      "autoload": {
        "psr-0": {
          "HTMLPurifier": "library/"
        },
        "files": ["library/HTMLPurifier.composer.php"]
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["LGPL"],
      "authors": [
        {
          "name": "Edward Z. Yang",
          "email": "admin@htmlpurifier.org",
          "homepage": "http://ezyang.com",
          "role": "Developer"
        }
      ],
      "description": "Standards compliant HTML filter written in PHP",
      "homepage": "http://htmlpurifier.org/",
      "keywords": ["html"],
      "time": "2013-11-30 08:25:19"
    }, {
      "name": "swiftmailer/swiftmailer",
      "version": "v5.3.1",
      "source": {
        "type": "git",
        "url": "https://github.com/swiftmailer/swiftmailer.git",
        "reference": "c5f963e7f9d6f6438fda4f22d5cc2db296ec621a"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/swiftmailer/swiftmailer/zipball/c5f963e7f9d6f6438fda4f22d5cc2db296ec621a",
        "reference": "c5f963e7f9d6f6438fda4f22d5cc2db296ec621a",
        "shasum": ""
      },
      "require": {
        "php": ">=5.3.3"
      },
      "require-dev": {
        "mockery/mockery": "~0.9.1"
      },
      "type": "library",
      "extra": {
        "branch-alias": {
          "dev-master": "5.3-dev"
        }
      },
      "autoload": {
        "files": ["lib/swift_required.php"]
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["MIT"],
      "authors": [
        {
          "name": "Chris Corbyn"
        }, {
          "name": "Fabien Potencier",
          "email": "fabien@symfony.com"
        }
      ],
      "description": "Swiftmailer, free feature-rich PHP mailer",
      "homepage": "http://swiftmailer.org",
      "keywords": ["mail", "mailer"],
      "time": "2014-12-05 14:17:14"
    }, {
      "name": "yiisoft/yii2",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-framework.git",
        "reference": "7ed175b4b71ac96eaf86aadc322186ecdc58498d"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-framework/zipball/7ed175b4b71ac96eaf86aadc322186ecdc58498d",
        "reference": "7ed175b4b71ac96eaf86aadc322186ecdc58498d",
        "shasum": ""
      },
      "require": {
        "bower-asset/jquery": "2.1.*@stable | 1.11.*@stable",
        "bower-asset/jquery.inputmask": "3.1.*",
        "bower-asset/punycode": "1.3.*",
        "bower-asset/yii2-pjax": ">=2.0.1",
        "cebe/markdown": "~1.0.0",
        "ext-mbstring": "*",
        "ezyang/htmlpurifier": "4.6.*",
        "lib-pcre": "*",
        "php": ">=5.4.0",
        "yiisoft/yii2-composer": "*"
      },
      "bin": ["yii"],
      "type": "library",
      "extra": {
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Qiang Xue",
          "email": "qiang.xue@gmail.com",
          "homepage": "http://www.yiiframework.com/",
          "role": "Founder and project lead"
        }, {
          "name": "Alexander Makarov",
          "email": "sam@rmcreative.ru",
          "homepage": "http://rmcreative.ru/",
          "role": "Core framework development"
        }, {
          "name": "Maurizio Domba",
          "homepage": "http://mdomba.info/",
          "role": "Core framework development"
        }, {
          "name": "Carsten Brandt",
          "email": "mail@cebe.cc",
          "homepage": "http://cebe.cc/",
          "role": "Core framework development"
        }, {
          "name": "Timur Ruziev",
          "email": "resurtm@gmail.com",
          "homepage": "http://resurtm.com/",
          "role": "Core framework development"
        }, {
          "name": "Paul Klimov",
          "email": "klimov.paul@gmail.com",
          "role": "Core framework development"
        }
      ],
      "description": "Yii PHP Framework Version 2",
      "homepage": "http://www.yiiframework.com/",
      "keywords": ["framework", "yii2"],
      "time": "2014-12-07 16:42:41"
    }, {
      "name": "yiisoft/yii2-bootstrap",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-bootstrap.git",
        "reference": "ca82a7a03ff5ed0d43294803edf1342de4efad17"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-bootstrap/zipball/ca82a7a03ff5ed0d43294803edf1342de4efad17",
        "reference": "ca82a7a03ff5ed0d43294803edf1342de4efad17",
        "shasum": ""
      },
      "require": {
        "bower-asset/bootstrap": "3.3.* | 3.2.* | 3.1.*",
        "yiisoft/yii2": "*"
      },
      "type": "yii2-extension",
      "extra": {
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\bootstrap\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Qiang Xue",
          "email": "qiang.xue@gmail.com"
        }
      ],
      "description": "The Twitter Bootstrap extension for the Yii framework",
      "keywords": ["bootstrap", "yii2"],
      "time": "2014-12-07 16:42:41"
    }, {
      "name": "yiisoft/yii2-composer",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-composer.git",
        "reference": "7f300dd23b6c4d1e7effc81c962b3889f83e43c0"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-composer/zipball/7f300dd23b6c4d1e7effc81c962b3889f83e43c0",
        "reference": "7f300dd23b6c4d1e7effc81c962b3889f83e43c0",
        "shasum": ""
      },
      "require": {
        "composer-plugin-api": "1.0.0"
      },
      "type": "composer-plugin",
      "extra": {
        "class": "yii\\composer\\Plugin",
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\composer\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Qiang Xue",
          "email": "qiang.xue@gmail.com"
        }
      ],
      "description": "The composer plugin for Yii extension installer",
      "keywords": ["composer", "extension installer", "yii2"],
      "time": "2014-12-07 16:42:41"
    }, {
      "name": "yiisoft/yii2-swiftmailer",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-swiftmailer.git",
        "reference": "662f9a7daa2eba8c7a21ae2580425d82e0eb60c8"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-swiftmailer/zipball/662f9a7daa2eba8c7a21ae2580425d82e0eb60c8",
        "reference": "662f9a7daa2eba8c7a21ae2580425d82e0eb60c8",
        "shasum": ""
      },
      "require": {
        "swiftmailer/swiftmailer": "*",
        "yiisoft/yii2": "*"
      },
      "type": "yii2-extension",
      "extra": {
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\swiftmailer\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Paul Klimov",
          "email": "klimov.paul@gmail.com"
        }
      ],
      "description": "The SwiftMailer integration for the Yii framework",
      "keywords": ["email", "mail", "mailer", "swift", "swiftmailer", "yii2"],
      "time": "2014-12-07 16:42:41"
    }
  ],
  "packages-dev": [
    {
      "name": "bower-asset/typeahead.js",
      "version": "v0.10.5",
      "source": {
        "type": "git",
        "url": "https://github.com/twitter/typeahead.js.git",
        "reference": "5f198b87d1af845da502ea9df93a5e84801ce742"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/twitter/typeahead.js/zipball/5f198b87d1af845da502ea9df93a5e84801ce742",
        "reference": "5f198b87d1af845da502ea9df93a5e84801ce742",
        "shasum": ""
      },
      "require": {
        "bower-asset/jquery": ">=1.7"
      },
      "require-dev": {
        "bower-asset/jasmine-ajax": ">=1.3.1,<1.4",
        "bower-asset/jasmine-jquery": ">=1.5.2,<1.6",
        "bower-asset/jquery": ">=1.7,<1.8"
      },
      "type": "bower-asset-library",
      "extra": {
        "bower-asset-main": "dist/typeahead.bundle.js"
      }
    }, {
      "name": "fzaninotto/faker",
      "version": "v1.4.0",
      "source": {
        "type": "git",
        "url": "https://github.com/fzaninotto/Faker.git",
        "reference": "010c7efedd88bf31141a02719f51fb44c732d5a0"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/fzaninotto/Faker/zipball/010c7efedd88bf31141a02719f51fb44c732d5a0",
        "reference": "010c7efedd88bf31141a02719f51fb44c732d5a0",
        "shasum": ""
      },
      "require": {
        "php": ">=5.3.3"
      },
      "require-dev": {
        "phpunit/phpunit": "~4.0",
        "squizlabs/php_codesniffer": "~1.5"
      },
      "type": "library",
      "extra": {
        "branch-alias": []
      },
      "autoload": {
        "psr-0": {
          "Faker": "src/",
          "Faker\\PHPUnit": "test/"
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["MIT"],
      "authors": [
        {
          "name": "François Zaninotto"
        }
      ],
      "description": "Faker is a PHP library that generates fake data for you.",
      "keywords": ["data", "faker", "fixtures"],
      "time": "2014-06-04 14:43:02"
    }, {
      "name": "phpspec/php-diff",
      "version": "v1.0.2",
      "source": {
        "type": "git",
        "url": "https://github.com/phpspec/php-diff.git",
        "reference": "30e103d19519fe678ae64a60d77884ef3d71b28a"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/phpspec/php-diff/zipball/30e103d19519fe678ae64a60d77884ef3d71b28a",
        "reference": "30e103d19519fe678ae64a60d77884ef3d71b28a",
        "shasum": ""
      },
      "type": "library",
      "autoload": {
        "psr-0": {
          "Diff": "lib/"
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Chris Boulton",
          "homepage": "http://github.com/chrisboulton",
          "role": "Original developer"
        }
      ],
      "description": "A comprehensive library for generating differences between two hashable objects (strings or arrays).",
      "time": "2013-11-01 13:02:21"
    }, {
      "name": "yiisoft/yii2-codeception",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-codeception.git",
        "reference": "43d3763021bebd623713dfdef4d1b2b347b0eba1"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-codeception/zipball/43d3763021bebd623713dfdef4d1b2b347b0eba1",
        "reference": "43d3763021bebd623713dfdef4d1b2b347b0eba1",
        "shasum": ""
      },
      "require": {
        "yiisoft/yii2": "*"
      },
      "type": "yii2-extension",
      "extra": {
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\codeception\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Mark Jebri",
          "email": "mark.github@yandex.ru"
        }
      ],
      "description": "The Codeception integration for the Yii framework",
      "keywords": ["codeception", "yii2"],
      "time": "2014-12-07 16:42:41"
    }, {
      "name": "yiisoft/yii2-debug",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-debug.git",
        "reference": "12116d86a73cbc53dbbedd6f8362fbcee6b106c5"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-debug/zipball/12116d86a73cbc53dbbedd6f8362fbcee6b106c5",
        "reference": "12116d86a73cbc53dbbedd6f8362fbcee6b106c5",
        "shasum": ""
      },
      "require": {
        "yiisoft/yii2": "*",
        "yiisoft/yii2-bootstrap": "*"
      },
      "type": "yii2-extension",
      "extra": {
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\debug\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Qiang Xue",
          "email": "qiang.xue@gmail.com"
        }
      ],
      "description": "The debugger extension for the Yii framework",
      "keywords": ["debug", "debugger", "yii2"],
      "time": "2014-12-07 16:42:41"
    }, {
      "name": "yiisoft/yii2-faker",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-faker.git",
        "reference": "de82ea8f4a145c01f0fd7f1a91b87325ed876dfc"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-faker/zipball/de82ea8f4a145c01f0fd7f1a91b87325ed876dfc",
        "reference": "de82ea8f4a145c01f0fd7f1a91b87325ed876dfc",
        "shasum": ""
      },
      "require": {
        "fzaninotto/faker": "*",
        "yiisoft/yii2": "*"
      },
      "type": "yii2-extension",
      "extra": {
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\faker\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Mark Jebri",
          "email": "mark.github@yandex.ru"
        }
      ],
      "description": "Fixture generator. The Faker integration for the Yii framework.",
      "keywords": ["Fixture", "faker", "yii2"],
      "time": "2014-12-07 16:42:41"
    }, {
      "name": "yiisoft/yii2-gii",
      "version": "2.0.1",
      "source": {
        "type": "git",
        "url": "https://github.com/yiisoft/yii2-gii.git",
        "reference": "adbe1012ee62d44acfa734160170e416ea78c001"
      },
      "dist": {
        "type": "zip",
        "url": "https://api.github.com/repos/yiisoft/yii2-gii/zipball/adbe1012ee62d44acfa734160170e416ea78c001",
        "reference": "adbe1012ee62d44acfa734160170e416ea78c001",
        "shasum": ""
      },
      "require": {
        "bower-asset/typeahead.js": "0.10.*",
        "phpspec/php-diff": ">=1.0.2",
        "yiisoft/yii2": "*",
        "yiisoft/yii2-bootstrap": "*"
      },
      "type": "yii2-extension",
      "extra": {
        "branch-alias": {
          "dev-master": "2.0.x-dev"
        }
      },
      "autoload": {
        "psr-4": {
          "yii\\gii\\": ""
        }
      },
      "notification-url": "https://packagist.org/downloads/",
      "license": ["BSD-3-Clause"],
      "authors": [
        {
          "name": "Qiang Xue",
          "email": "qiang.xue@gmail.com"
        }
      ],
      "description": "The Gii extension for the Yii framework",
      "keywords": ["code generator", "gii", "yii2"],
      "time": "2014-12-07 16:42:41"
    }
  ],
  "aliases": [],
  "minimum-stability": "stable",
  "stability-flags": [],
  "prefer-stable": false,
  "prefer-lowest": false,
  "platform": {
    "php": ">=5.4.0"
  },
  "platform-dev": []
});
