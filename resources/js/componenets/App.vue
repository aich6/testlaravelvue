<script setup>
import axios from 'axios';
import { RouterLink, RouterView } from 'vue-router';

const logout = () => {
   //localStorage.removeItem('token');
   axios.post('api/auth/logout').then(response =>{
      console.log(response);
   });
}
</script>
<template>
   <header>
      <nav>
         <RouterLink to="/">Dashbord</RouterLink>
         <RouterLink to="/login">Login</RouterLink>
        
      </nav>
   </header>
   <router-view />
</template>


<style scoped>
*{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

</style>