#!/bin/bash
cd /opt/lampp/
sudo rm -rf task-list-private-files
cd htdocs/
sudo rm -rf task-list
cd ~/code/web/Projetos/web-modulo-2/app-task-list
sudo cp -r task-list-private-files/ /opt/lampp/task-list-private-files
cd htdocs/
sudo cp -r task-list/ /opt/lampp/htdocs/task-list
