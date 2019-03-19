#!/bin/bash
cd /opt/lampp/
sudo rm -rf help-desk-private-files
cd htdocs/
sudo rm -rf help-desk
cd ~/code/web/Projetos/web-modulo-2/app-help-desk
sudo cp -r help-desk-private-files/ /opt/lampp/help-desk-private-files
cd htdocs/
sudo cp -r help-desk/ /opt/lampp/htdocs/help-desk
