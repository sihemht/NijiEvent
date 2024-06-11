import React, { Component } from "react";
import axios from "axios";
import { Link } from "react-router-dom"; 
import "../login/login.css";



class Register extends Component {
  handleSubmit = async (event) => {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    try {
      const response = await axios.post("http://localhost:8080/api/register", {
        email: email,
        username: username,
        password: password,
      });
      console.log("API reponse", response.data);
      this.props.history.push("/register");
    } catch (error) {
      console.error("Erreur api:", error);
    }
  };
  render() {
    return (
      <div className="loginRegister">
        <h4>Sign In</h4>
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
              type="text"
              id="username"
              name="username"
              defaultValue="username"
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
          <input type="submit" value="Sign Up" className="btn" />
        </form>
        <Link to="/login" className="link">
          Sign In
        </Link>
      </div>
    );
  }
}

export default Register;
