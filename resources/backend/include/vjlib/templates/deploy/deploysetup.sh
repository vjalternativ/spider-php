cd docroot
mv project projectold
mkdir project

cd project
##CLEAN ALL FILES
#rm -rf *


##SETUP PROJECT
git init
git config user.email "vj.alternativ@gmail.com"
git config user.name "vijay"
git pull https://vjalternativ:password@github.com/vjalternativ/repo.git master
mkdir templates_c
mkdir locks
mkdir cache
mv ../projectold/media_files .



#SETUP  CONTROLAREA
mkdir controlarea
cd controlarea
git init
git config user.email "vj.alternativ@gmail.com"
git config user.name "vijay"
git pull https://vjalternativ:password@github.com/vjalternativ/spider-php.git master
mkdir templates_c
mkdir cache
cd ../../
chmod -R 755 project
rm -rf projectold
