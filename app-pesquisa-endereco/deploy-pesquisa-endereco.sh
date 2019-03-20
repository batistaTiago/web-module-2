#!/bin/bash
cd /opt/lampp/htdocs/
sudo rm -rf pesquisa-endereco
cd ~/code/web/Projetos/web-modulo-2/app-pesquisa-endereco/htdocs
sudo cp -r pesquisa-endereco/ /opt/lampp/htdocs
