#!/bin/bash

# Installer Git
apt-get update
apt-get install -y git

# Exécuter la commande de démarrage par défaut
exec "$@"
