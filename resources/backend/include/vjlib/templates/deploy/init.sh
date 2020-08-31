mkdir templates_c
mkdir locks
mkdir cache


#SETUP  CONTROLAREA
mkdir controlarea
cd controlarea
git init
git config user.email "vj.alternativ@gmail.com"
git config user.name "vijay"
git pull https://vjalternativ:password@github.com/vjalternativ/spider-php.git master
mkdir templates_c
mkdir cache

cd ../

cp controlarea/include/vjlib/templates/frontend/index.php .
cp controlarea/include/vjlib/templates/frontend/.htaccess .
cp controlarea/include/vjlib/templates/frontend/.gitignore .

cp controlarea/config.php .
cp controlarea/cronconfig.php .
cp controlarea/cronthread.php .
cp controlarea/extraconfig.php .
cp controlarea/seoconfig.php .


chmod -R 755 controlarea
