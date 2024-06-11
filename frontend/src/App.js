import React from 'react';
import Login from './component/login/login';
import Register from './component/register/register';
import Profile from './component/navbar';
import { BrowserRouter, Routes, Route } from "react-router-dom";

function App () {
    
    return (
      <BrowserRouter>
        <Routes>
          <Route className='container'>
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/profile" element={<Profile />} />
          </Route>
        </Routes>
      </BrowserRouter>
    );
}

export default App;
