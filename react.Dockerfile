# Utilisez une image Node.js comme base
FROM node:18-alpine

# Définissez le répertoire de travail dans le conteneur
WORKDIR /app

# Copiez le package.json et le package-lock.json dans le conteneur
COPY frontend/package.json ./
COPY frontend/package-lock.json ./

# Installez les dépendances
# RUN npm install

# Copiez le reste du code source dans le conteneur
COPY . .

# Exposez le port 3000 pour le serveur de développement
EXPOSE 3000

# Commande pour démarrer l'application React
CMD ["npm", "start"]
