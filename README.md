kekrozsak
=========

This repository contains the source code of a CMS/social site written in
PHP 5.3 using the Symfony 2.1 framework.

The site is originally the engine of http://bluroses.hu/ but I meant it to be totally open source.

Installation
------------

After first downloading the repository, you should run

    ./composer.phar update

to fetch all the required dependencies.

After each pull, you should run

    ./update.sh

to update everything else (git submodules, cache, assets and so on). If update.sh is changed, I advise to run it again. It can do no harm...

Contributing
------------

If you want to contribute to this project for any reason, you can do it in the GitHub way: fork the repository, modify the source and create a pull request.

If you can't write code in PHP, but have an idea, feel free to open an issue.
