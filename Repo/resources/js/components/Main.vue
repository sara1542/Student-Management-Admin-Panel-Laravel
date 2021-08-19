
 <template>
<div>
    <router-view></router-view>
    <div style="text-align: center " class="w-100 p-3 mw-100">
        
    <router-link to="/Vstudents" class="btn btn-primary"> View Students</router-link>
    <router-link to="/Vcourses" class="btn btn-danger"> View Courses</router-link>
    <router-link to="/Vlevels" class="btn btn-warning"> View Levels</router-link>
    <router-link to="/Vprograms" class="btn btn-dark"> View Programs</router-link>
   

    </div>
</div>
</template>

