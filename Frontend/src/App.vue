<template>
  <div id="app">
    <header>
      <nav class="navbar bg-dark border-bottom border-bottom-dark" data-bs-theme="dark" id="navbar">
        <ul>
          <router-link to="/">Home</router-link>
        </ul>
        <div class="user-info">
          <a href="./components/UserDetails.vue" class="username">Username</a>
          <button @click="logout" class="btn btn-outline-danger" id="logout">Logout</button>
        </div>
      </nav>
    </header>

    <div class="center-content">
      <router-view></router-view>
    </div>
  </div> 
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();


function logout() {
  localStorage.clear("token");
  router.push('/login');
}

</script>

<style>
body {
  background-image: url("./components/icons/abstract-digital-grid-black-background.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}

.center-content {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

#navbar {
  background-color: #333;
  color: #fff;
  padding: 5px;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 1000;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 40px;
  padding-left: 5%;
  align-items: center;
  display: flex;
}

nav ul li {
  display: inline;
  margin-right: 10px;
}

nav ul li a {
  color: #ffffff;
  text-decoration: none;
}

#logout {
  margin-right: 25px;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 22px;
}

#app .container{
  position: relative;
  left: 80px;
  top: 200px;
}

.username{
  font-family: 'Bebas Neue', sans-serif;
  font-size: 22px;
  margin-right: 10px;
}

.user-info {
  display: flex;
  align-items: center;
}
</style>