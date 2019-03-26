#!/bin/bash
cd /opt/lampp/htdocs/
sudo rm -rf app-dashboard
cd ~/code/web/Projetos/web-modulo-2/app-dashboard/htdocs
sudo cp -r app-dashboard/ /opt/lampp/htdocs
