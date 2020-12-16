Robin's Geotag Weather Module
==================================

Install as an Anax module
------------------------------------

## Installation
Make sure that the following namespace is set in your composer.json in your Anax installation:

"Robin\\": "src/"

Also make sure to update composer by running the command "composer update" in your main Anax installation folder.

## Copying files
Install the module by entering the following commands:

## Copy config files
rsync -av vendor/robingranqvist/geotag/config/di/covalidator.php ./
rsync -av vendor/robingranqvist/geotag/config/router ./
rsync -av vendor/robingranqvist/geotag/config/keys.php ./

## Copy src files
rsync -av vendor/robingranqvist/geotag/src ./

## Copy views
rsync -av vendor/robingranqvist/geotag/view ./

## Copy unit test files
$ rsync -av vendor/robingranqvist/geotag/test/Controller ./test/

## Copy the documentation
rsync -av vendor/robingranqvist/geotag/README.md ./content/weather-module-info.md
