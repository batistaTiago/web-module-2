#!/bin/bash
cd /opt/lampp/
sudo rm -rf php-pdo-private-files
cd htdocs/
sudo rm -rf php-pdo
cd ~/code/web/Projetos/web-modulo-2/php-pdo
sudo cp -r php-pdo-private-files/ /opt/lampp/php-pdo-private-files
cd htdocs/
sudo cp -r php-pdo/ /opt/lampp/htdocs/php-pdo
