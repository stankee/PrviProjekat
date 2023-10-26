<template>
    <div class="weather-box">
      <div class="weather-info">
        <!-- <h2>Weather Information</h2> -->
        <img v-if="icon" :src="icon" alt="Weather Icon" id="icon">
        <!-- <p v-if="weather" id="weather">{{ weather }}</p> -->
        <p v-if="temp_c" id="temp">{{ temp_c }} °C</p>
        <p v-if="location" id="location">{{ location }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        location: null,
        weather: null,
        icon: null,
        temp_c: null
      };
    },
    mounted() {
      this.getUserLocation();
    },
    methods: {
      getUserLocation() {
        if (!navigator.geolocation) {
          console.error('Geolocation is not supported by this browser.');
          return;
        }
  
        navigator.geolocation.getCurrentPosition(
          position => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            this.getWeatherData(latitude, longitude);
          },
          error => {
            console.error('Error:', error);
          }
        );
      },
      getWeatherData(latitude, longitude) {
        const options = {
          method: 'GET',
          url: 'https://weatherapi-com.p.rapidapi.com/current.json',
          params: { q: `${latitude},${longitude}` },
          headers: {
            'X-RapidAPI-Key': 'febb3ef454msh1fd56f8b23cc100p1c137bjsnaddb0f3e8ad6',
            'X-RapidAPI-Host': 'weatherapi-com.p.rapidapi.com'
          }
        };
  
        axios
          .request(options)
          .then(response => {
            this.location = response.data.location.name;
            this.weather = response.data.current.condition.text;
            this.icon = response.data.current.condition.icon;
            this.temp_c = response.data.current.temp_c;
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    }
  };
  </script>
  
  <style>
@import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');

  .weather-box {
    position: fixed;
    bottom: 65px;
    right: 80px;
    background-color: rgba(75, 151, 109, 0.3);
    padding: 22px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    font-family: 'Orbitron', sans-serif; 
  }
  
  .weather-info {
    text-align: center;
  }
  
  .weather-info h2 {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .weather-info p {
    font-size: 24px;
    margin-bottom: 5px;
    color: azure;
  }
  
  .weather-info img {
    width: 120px;
    height: 120px;
    margin-bottom: 3px;
  }
  </style>
  