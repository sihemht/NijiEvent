import React, { Component } from "react";
import "../App.css";
import Announcement from "./announcement";
import SearchBar from "./searchBar";
import Container from "@mui/material/Container";

import { useEffect, useState } from "react";
import axios from "axios";
import Grid from "@mui/material/Grid";


const Feed = () => {
  const [announcements, setAnnouncements] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8080/api/events")
      .then((response) => {
        setAnnouncements(response.data);
        console.log(response.data);
      })
      .catch((error) => {
        console.error("There was an error fetching the announcements!", error);
      });
  }, []);

  return (
    <Container>
  <SearchBar />
  <Grid container spacing={4} mt={2}>
    {announcements.map((announcement) => (
      announcement.current_state == "published" ? (
        <Grid item key={announcement.id} xs={12}>
          <Announcement
            speaker={announcement.speaker_username}
            speed={announcement.speed}
            date={announcement.proposed_date}
            picture={announcement.picture}
            title={announcement.title}
            time={announcement.time}
            description={announcement.description}
          />
        </Grid>
      ) : null
    ))}
  </Grid>
</Container>
  );
};

export default Feed;
