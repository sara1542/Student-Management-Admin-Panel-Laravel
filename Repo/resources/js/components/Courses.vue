 <template> 
<div>
    <link href="/css/main.css" rel="stylesheet">
        <br><br>
    <div class="row">
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Courses</h5>

                    <label class ="btn badge-success">Search by Course Name</label> 
                    <form @submit.prevent="filterCourse(valueToSearch)" style="display:inline"> 
                        <input type ="text" v-model="valueToSearch" >
                    <button class ="btn badge-success" type="submit" >Go</button> 
                    <button class ="btn badge-success" @click.prevent="fetchCourses('')" >All</button> 
                    </form>

                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Level</th>
                                <th>Program</th>
                                <th>Description</th>
                                <th>Update</th>
                                <th>Delete</th>
                                <th>Grade Setup</th>
                            </tr>
                        </thead>
                        <tr v-for="course in courses" v-bind:key="course.id">
                                <th>{{course.id}}</th>
                                <td><router-link :to="`/CourseStudents/${course.Code}/${course.id}`">{{course.Name}}</router-link></td>
                                <td>{{course.Code}}</td>
                                <td>{{course.Level}}</td>
                                <td>{{course.Program}}</td>
                                <td>{{course.Description}}</td>
                                <td> <button class="btn badge-success" @click="editCourse(course)">Edit</button> </td>
                               <td> <button class="btn badge-success" @click="deleteCourse(course.id)">Delete</button> </td>
                               <td> <router-link :to="`/GradeSetup/${course.id}`">Grade Setup</router-link> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <h4> Course</h4>
<form @submit.prevent="addCourse" class="md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="name" v-model="course.Name" required>
                 <input type="text" class="form-control" placeholder="code" v-model="course.Code" required>
                <input type="text" class="form-control" placeholder="description" v-model="course.Description" required>
                <label>Level</label>
                <select style="width:200px;font-family: cursive; " v-model="course.Level" required> 
                        <option name="1" > 1</option> 
                        <option name="2"> 2 </option> 
                        <option name="3"> 3 </option> 
                        <option name="4"> 4 </option> 
                </select> 
                <br>
                <label>Program</label>
                 <select style="width:200px;font-family: cursive; "  v-model="course.Program" required> 
                        <option v-for="program in programs" v-bind:key="program.id" name="1" > {{ program.Name}}</option> 
                </select> 

            </div>
            <button type="submit" class="btn badge-success"  v-show="editcourse">Update</button>
            <button type="submit" class="btn badge-success" v-show="!editcourse" >Add new Course</button>
        </form>
        <br><br>  
</div>
</template>
<script>
  export default {
        data(){
            return{
                courses: [],
                course: {
                    id: '',
                    Name: '',
                    Code: '',
                    Level: '',
                    Program: '',
                    Description: '',
                },
                programs: [],
                program: {
                    id: '',
                    Name: '',
                    Description: '',
                },
                program_id: '',
                course_id: '',
                pagination: {},
                editcourse:       false,
                valueToSearch: '',
                selected:''
            }
        },
        created(){
            this.fetchCourses();
            this.fetchPrograms();
        },
        methods:{
            fetchCourses(page_url) {
                page_url = page_url || '/api/courses';
                fetch(page_url)
                    .then((res) => res.json())
                    .then((res) => {
                    this.courses = res.data;
                    })
                    .catch((err) => console.log(err));
                },
                fetchPrograms(page_url) {
                page_url = page_url || '/api/programs';
                fetch(page_url)
                    .then((res) => res.json())
                    .then((res) => {
                    this.programs = res.data;
                    })
                    .catch((err) => console.log(err));
                },
            deleteCourse(id){
                        if(confirm('Are You Sure?')){
                            fetch(`api/course/${id}`,{
                                method:'delete'
                            })
                                .then(res => res.json())
                                .then(data =>{
                                    this.fetchCourses();
                                })
                                .catch(err => console.log(err))
                        }
                    },
            addCourse(){
                
                console.log(this.editcourse);
                        if(this.editcourse === false){
                            
                            console.log('In add');
                            //Add
                            fetch(`api/course`,{
                                method:     'post',
                                body:       JSON.stringify(this.course),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                            this.course.Name=  '';
                            this.course.Code=  '';
                            this.course.Level=  '';
                            this.course.Program=  '';
                            this.course.Description= '';
                                    this.fetchCourses();
                                })
                                .catch(err => console.log(err));
                        }else{
                            console.log('In update');
                            //Update
                            fetch('api/course',{
                                method:     'put',
                                body:       JSON.stringify(this.course),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                                     this.course.id = '';
                            this.course.course_id = '';
                            this.course.Name=  '';
                            this.course.Code=  '';
                            this.course.Level=  '';
                            this.course.Program=  '';
                            this.course.Description= '';
                                    this.fetchCourses();
                                    this.editcourse=false;
                                })
                                .catch(err => console.log(err));
                        }
                        
                        
                    },
            editCourse(course){
                        this.editcourse = true;
                        this.course.course_id = course.id;
                        this.course.id = course.id;
                        this.course.Name=  course.Name;
                        this.course.Code=  course.Code;
                        this.course.Level=  course.Level;
                            this.course.Program=  course.Program;
                        this.course.Description= course.Description;
                    },
            filterCourse(valueToSearch){
                        fetch(`api/Scourses/${valueToSearch}`)
                            .then(res => res.json())
                            .then(res => {
                                this.courses = res.data;
                            })
                            .catch(err => console.log(err));

                    }
  },
        }
    
</script>
