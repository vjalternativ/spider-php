#!/bin/bash
echo "INSTALLING POST SCRIPT"
read -p "sitetpl?" sitetpl
folder=`basename $PWD`
cd ../../../
rm -rf include/entrypoints/site/widgets/$sitetpl/$folder

mkdir -p include/entrypoints/site/widgets/$sitetpl/

cp -r node_modules/@spider-php-widgets/$folder include/entrypoints/site/widgets/$sitetpl/
rm -rf include/entrypoints/site/widgets/$sitetpl/$folder/install.sh
rm -rf include/entrypoints/site/widgets/$sitetpl/$folder/package.json
rm -rf node_modules/

echo "INSTALLATION COMPLETE"
