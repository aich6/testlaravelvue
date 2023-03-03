<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from 'vue-router';

const router = useRouter()
const user = ref({});
onMounted(() => {
    user.value = JSON.parse(localStorage.getItem("user")); 
    console.log(user.value);
});

const logout = async () => {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    router.push('/login')
    await axios.post("/api/auth/logout");
    
  
};
</script>
<template>
    <h1>
        Welcome {{ user.name }}
        <a class="button" @click.prevent="logout">Logout</a>
    </h1>
</template>
