import React, { useState } from "react";
import Profile from "../component/user/profile";
import Avatar from "@mui/material/Avatar";
import Feed from "./feed";
import Interacted from "../component/user/interacted";
import Suggest from "./suggest";

function Navbar() {
  const [activeComponent, setActiveComponent] = useState(null);

  const handleFeedClick = () => {
    setActiveComponent("feed");
  };

  const handleSuggestClick = () => {
    setActiveComponent("suggest");
  };

  const handleProfileClick = () => {
    setActiveComponent("profile");
  };

  const handleInteractedClick = () => {
    setActiveComponent("interacted");
  };

  return (
    <div className="container">
      <div className="profile">
        <div>
        <Avatar alt="profile" src="/static/images/avatar/1.jpg" />
        <h1>User Name</h1>
        </div>
        <div className="navigation">
          <p className="link" onClick={handleFeedClick}>
            Feed
          </p>
          <p className="link" onClick={handleSuggestClick}>
            Suggest
          </p>
          <p className="link" onClick={handleInteractedClick}>
            Interacted
          </p>
          <p className="link" onClick={handleProfileClick}>
            Profile
          </p>
        </div>
        <div>Log out</div>
      </div>
      <div className="feed">
        {activeComponent === "feed" && <Feed />}
        {activeComponent === "suggest" && <Suggest />}
        {activeComponent === "interacted" && <Interacted />}
        {activeComponent === "profile" && <Profile />}
      </div>
    </div>
  );
}

export default Navbar;
