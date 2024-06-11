import React, { Component } from 'react';
import axios from 'axios';
import { Link } from "react-router-dom"; 
import "./login.css";

class Login extends Component {
  handleSubmit = async (event) => {
    event.preventDefault(); // Empêcher le formulaire de se soumettre de manière conventionnelle

    // Récupérer les valeurs des champs de saisie
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    try {
      // Envoyer une requête POST à votre API Symfony pour l'authentification
      const response = await axios.post('http://localhost:8080/api/login', {
        email: email,
        password: password
      });

      // Gérer la réponse de l'API en cas de succès
      console.log('Réponse de l\'API:', response.data);
      this.props.navigate("/profile");
    } catch (error) {
      // Gérer les erreurs
      console.error('Erreur lors de la connexion:', error);
    }
  }

  render() {
    return (
        <div className="loginRegister">
          <h4>Login</h4>
          <form onSubmit={this.handleSubmit}>
            <div className="text_area">
              <input
                type="text"
                id="email"
                name="email"
                defaultValue="test1@example.com"
                className="text_input"
              />
            </div>
            <div className="text_area">
              <input
                type="password"
                id="password"
                name="password"
                defaultValue="password"
                className="text_input"
              />
            </div>
            <input
              type="submit"
              value="LOGIN"
              className="btn"
            />
          </form>
          <Link to="/register" className="link">
            Sign Up
          </Link>
        </div>
    );
  }
}

export default Login;
