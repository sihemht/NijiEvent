import React, { Component } from 'react';
import axios from 'axios';
import TextField from '@mui/material/TextField';
import { Formik, Form, Field } from 'formik';
import Button from '@mui/material/Button';
import CloudUploadIcon from '@mui/icons-material/CloudUpload';
import Box from '@mui/material/Box';
import Container from '@mui/material/Container';
import * as Yup from 'yup';

const ProfileSchema = Yup.object().shape({
  username: Yup.string().required('Username is required'),
  password: Yup.string().required('Password is required'),
  profilePicture: Yup.mixed().required('Profile picture is required')
});

class Profile extends Component {
  constructor(props) {
    super(props);
    this.state = {
      username: '',
      password: '',
      profilePicture: null
    };
  }

  handleSubmit = (values) => {
    const formData = new FormData();
    formData.append('username', values.username);
    formData.append('password', values.password);
    formData.append('profilePicture', values.profilePicture);

    axios.get('http://localhost:8080/api/users/66', formData)
      .then(response => {
        console.log(response.data);
      })
      .catch(error => {
        console.error('There was an error updating the profile!', error);
      });
  };

  render() {
    return (
      <Container
        component=""
        sx={{
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
          mt: 4,
          '& .MuiTextField-root': { mb: 2, width: '100%' },
        }}
        noValidate
        autoComplete="off"
        onSubmit={(e) => {
          e.preventDefault();
          // Handle form submission
          console.log('Form submitted');
        }}
      >
        <div className="profile-container">
          <h2>Edit your Profile</h2>
          <Formik
            initialValues={this.state}
            validationSchema={ProfileSchema}
            onSubmit={this.handleSubmit}
          >
            {({ setFieldValue }) => (
              <Form>
                <Box sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center', mb: 3 }}>
                  <TextField
                    className="outlined-textarea"
                    name="username"
                    label="Username"
                    placeholder="New Username"
                    multiline
                    fullWidth
                  />
                  <TextField
                    className='outlined-textarea'
                    name='password'
                    label='Password'
                    type='password'
                    placeholder='New password'
                    fullWidth
                  />
                </Box>
                <Button
                  component="label"
                  variant="contained"
                  startIcon={<CloudUploadIcon />}
                  sx={{ mb: 2 }}
                  fullWidth
                >
                  Upload file
                  <input
                    name="profilePicture"
                    type="file"
                    style={{ display: 'none' }}
                    onChange={(event) => {
                      setFieldValue('profilePicture', event.currentTarget.files[0]);
                    }}
                  />
                </Button>
                <Button
                  type='submit'
                  variant='contained'
                  sx={{ mb: 2 }}
                >
                  Submit
                </Button>
              </Form>
            )}
          </Formik>
        </div>
      </Container>
    );
  }
}

export default Profile;
