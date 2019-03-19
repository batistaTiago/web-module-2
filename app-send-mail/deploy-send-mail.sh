#!/bin/bash
cd /opt/lampp/
sudo rm -rf send-mail-private-files
cd htdocs/
sudo rm -rf send-mail
cd ~/code/web/Projetos/web-modulo-2/app-send-mail
sudo cp -r send-mail-private-files/ /opt/lampp/send-mail-private-files
cd htdocs/
sudo cp -r send-mail/ /opt/lampp/htdocs/send-mail
