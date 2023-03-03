import { createRouter, createWebHashHistory } from "vue-router";
import Dashbord from "../componenets/Dashbord.vue";
import Login from "../componenets/Login.vue";

const routes = [
    {
        path: "/",
        component: Dashbord,
        name:'Dashbord',
        meta:{
            requireAuth:true
        }
    },
    {
        path: "/login",
        name:'Login',
        component: Login,
        meta:{
            requireAuth:false
        }
    },
];
const router = createRouter({
   
    history: createWebHashHistory(),
    routes, 
})

router.beforeEach((to,from)=>{
    if(to.meta.requireAuth && !localStorage.getItem('token')){
        return {name:'Login'}
    }
    if(to.meta.requireAuth == false && localStorage.getItem('token')){
        return {path:'/'}
    }
})

export default router;