#Installation

## Method - 1 - Use spider-php as composer package

### create a new php project in eclipse
* click on file
* click on new
* click on php project
* enter project name
* click on finish

### add composer support in your newly created project
* right click on project
* click on configure
* click on add composer support


## Method 2 - Use spider-php as symbolic link

###import the spider-php project into eclipse workspace

####or git clone spider-php from github

git clone https://github.com/vjalternativ/spider-php.git
 
 

### create a php project in eclipse 

### either copy the spider-php folder into your project 

### or symbolic link (shortcut link) the spider-php into your project

cd <your-project-folder>
ln -s /var/www/html/spider-php .

### copy all the files and folders from spider-php/include/templates into your project


### copy .htaccess files to which would not show in eclipse project explorer. eiher you can get the .htaccess file in spider-php/include/docs/templates/.htaccess or also you can use shortcut command ctrl+shift+f and search .htaccess file.

### configure db, urlbasepath in config.php for localhost in your project

### configure basepath in cliconfig.php in localhost your project


### install default database schema by running the command

cd <yourprojectpath>

php index.php spider install


## now you can login into backend with below credentials

url <baseurl>/backend
username : vjalternativ
password : workst@48







