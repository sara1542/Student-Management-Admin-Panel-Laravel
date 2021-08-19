import Vue from 'vue';
import VueRouter from 'vue-router';
import StudentCourses from './components/StudentCourses.vue';
import List from './components/List.vue';
import Levels from './components/Levels.vue';
import Handsontable from 'handsontable';
import 'handsontable/dist/handsontable.full.css';


Vue.use(VueRouter);
const routes=[
    {path:"/StudentCourses/:studentID/:id" , component:require('./components/StudentCourses.vue').default},
    {path:"/CourseStudents/:courseCode/:id" , component:require('./components/CourseStudents.vue').default},
    {path:"/LevelCourses/:id" , component:require('./components/LevelCourses.vue').default},
    {path:"/ProgramCourses/:Name" , component:require('./components/ProgramCourses.vue').default},
    {path:'/Vstudents' , component:require('./components/List.vue').default},
    {path:'/Vcourses' , component:require('./components/Courses.vue').default},
    {path:'/Vlevels' , component:require('./components/Levels.vue').default},
    {path:'/Vprograms' , component:require('./components/Programs.vue').default},
    {path:'/GradeSetup/:courseIDD' , component:require('./components/GradeSetup.vue').default}
]
const router = new VueRouter({
    routes:routes,
    mode:"history"
})
 require('./bootstrap');

 window.Vue = require('vue');

 Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('student', require('./components/Main.vue').default);
 
 const app = new Vue({
    //  el: '#app',
     router
 }).$mount("#app");