My Blog simple blog API on Symfony
==========

A Symfony project created on March 31, 2018, 10:58 pm.

INSTALL PROJECT INSTRUCTIONS

Project need php5.6 apache and mysql

Open terminal in path of project
Install composer into path of project (use instruction from https://getcomposer.org/download/)
sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
sudo php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php
sudo php -r "unlink('composer-setup.php');"

Install vendors
sudo php composer.phar install

create empty database and config parameters.yml

sudo php bin/console doctrine:schema:update --force
sudo php bin/console cache:clear
sudo php bin/console server:run

To create admin use command:
sudo php bin/console fos:user:create adminuser –super-admin

		API MANUAL
/login -  login form, logout button  – for GUEST

/register – registration form  – for GUEST

/cat – get categories api output format – json – access enabled for GUEST, USER, ADMIN

/cat/new - method GET – get create category form – access enabled for ADMIN

/cat/new - method POST – create category api – access enabled for ADMIN

/cat/delete/{id} – method POST – delete category by id api – access enabled for ADMIN

/articles  - get articles api output format – json – access enabled for GUEST, USER, ADMIN

/articles/cat/{id} - get articles by category api output format – json – access enabled for GUEST, USER, ADMIN

/article/new -  method GET – get create article form – access enabled for ADMIN

/article/new - method POST – create article api – access enabled for ADMIN

/article/edit/{id} -  method GET – get edit article by id form – access enabled for USER ADMIN

/article/edit/{id} - method POST – edit article by id  api – access enabled for USER ADMIN

/article/delete/{id} – method POST – delete article by id api – access enabled for ADMINN

