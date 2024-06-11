import * as React from 'react';
import TextField from '@mui/material/TextField';
import Container from '@mui/material/Container';
import Button from '@mui/material/Button';
import CloudUploadIcon from '@mui/icons-material/CloudUpload';
import Box from '@mui/material/Box';
import { styled } from '@mui/material/styles';
import { DatePicker } from '@mui/x-date-pickers/DatePicker';
import { LocalizationProvider } from '@mui/x-date-pickers/LocalizationProvider';
import { AdapterDateFns } from '@mui/x-date-pickers/AdapterDateFns';
import { Unstable_NumberInput as NumberInput } from '@mui/base/Unstable_NumberInput';


const VisuallyHiddenInput = styled('input')({
  clip: 'rect(0 0 0 0)',
  clipPath: 'inset(50%)',
  height: 1,
  overflow: 'hidden',
  position: 'absolute',
  bottom: 0,
  left: 0,
  whiteSpace: 'nowrap',
  width: 1,
});

export default function Suggest() {
  const [formData, setFormData] = React.useState({
    current_state: 'to_review',
    type: 'test',
    speed: 5,
    title: 'test',
    description: 'test',
    picture: '',
    vote: 100,
    proposedDate: '2024-06-01 08:04:00.000000',
    speaker_username: 'ethelyn.schamberger',
    proposed_by_username: 'ethelyn.schamberger',
    "votes": []
  });

  const handleDateChange = (newDate) => {
    setFormData((prevData) => ({ ...prevData, proposedDate: newDate }));
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({ ...prevData, [name]: value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch('http://localhost:8080/api/events', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          current_state: 'to_review',
          type: formData.type,
          speed: formData.speed,
          title: formData.title,
          description: formData.description,
          picture: formData.picture,
          vote: Math.floor(Math.random() * (60 - 5 + 1)) + 5, // Random vote
          proposed_date: formData.proposedDate,
          speaker_username: 'bartoletti.deangelo', 
          proposed_by_username: 'lavada.pagac',
          votes: [],
   
        }),
      });

      if (response.ok) {
        console.log('Event created successfully');
        console.log(formData)
      } else {
        console.log(formData);
        console.error('Failed to create event');
      }
    } catch (error) {
      console.error('Error:', error);
    }
    
    //const formattedDate = selectedDate ? format(selectedDate, "yyyy-MM-dd HH:mm:ss.SSSSSS") : null;
  };


  return (
    <LocalizationProvider dateAdapter={AdapterDateFns}>
      <Container
        component="form"
        sx={{
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
          mt: 4,
          '& .MuiTextField-root': { mb: 2, width: '100%' },
        }}
        noValidate
        autoComplete="off"
        onSubmit={handleSubmit}
      >
        <Box sx={{ width: '100%', maxWidth: '500px' }}>
          <h1> Suggest a topic! </h1>
          <TextField
            id="outlined-multiline-flexible"
            label="Username"
            disabled
            multiline
            maxRows={4}
            fullWidth
            value='ethelyn.schamberger'
            // value={formData.username}
          />
          <TextField
            id="outlined-textarea"
            label="Title"
            placeholder="Title"
            multiline
            fullWidth
            name="title"
            value={formData.title}
            onChange={handleChange}
          />
           <TextField
            id="outlined-textarea-type"
            label="Type"
            placeholder="Type"
            multiline
            fullWidth
            name="type"
            value={formData.type}
            onChange={handleChange}
          />
             <TextField 
             min={10} step={5}
          id="outlined-number-speed"
          label="Time"
          type="number"
          name="time"
          value={formData.speed}
          InputLabelProps={{
            shrink: true,
          }}
        />
          
          <Box sx={{ display: 'flex', alignItems: 'center', mb: 2 }}>
            <Button
              component="label"
              variant="contained"
              startIcon={<CloudUploadIcon />}
              sx={{ mr: 2 }}
            >
              Picture
              <VisuallyHiddenInput
                type="file"
                onChange={(e) => setFormData((prevData) => ({
                  ...prevData,
                  picture: URL.createObjectURL(e.target.files[0]),
                }))}
              />
            </Button>
            <TextField
              id="outlined-textarea"
              label="Speaker"
              placeholder="Speaker name"
              fullWidth
              name="speaker"
              value={formData.speaker}
              onChange={handleChange}
            />
          </Box>
          <DatePicker
            label="Suggest a date"
            value={formData.proposedDate}
            dateFormat="dd/MM/yyyy"
            onChange={handleDateChange}
            renderInput={(params) => <TextField {...params} fullWidth />}
          />
          <TextField
            id="outlined-multiline-static"
            label="Description"
            multiline
            rows={4}
            fullWidth
            name="description"
            value={formData.description}
            onChange={handleChange}
          />
          <Button
            type="submit"
            variant="contained"
            color="primary"
            sx={{ mt: 2 }}
          >
            Propose
          </Button>
          <Button
            type="submit"
            variant="contained"
            color="primary"
            sx={{ mt: 2 }}
          >
            Draft
          </Button>
        </Box>
      </Container>
    </LocalizationProvider>
  );
}
