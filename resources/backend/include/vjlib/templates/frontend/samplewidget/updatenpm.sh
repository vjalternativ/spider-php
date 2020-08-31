#!/bin/bash
folder=`basename $PWD`
npm install --ignore-scripts --prefix ./ @spider-php-widgets/$folder
cp ./node_modules/@spider-php-widgets/$folder/package.json .
cp ./node_modules/@spider-php-widgets/$folder/install.sh .
php updatenpm.php
rm -rf npm-debug.log
rm -rf etc/
rm -rf node_modules/
npm publish --access public
rm -rf install.sh

