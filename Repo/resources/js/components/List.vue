
 <template>
 
<div>
    <link href="/css/main.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>

                    <label class ="btn badge-success">Search by</label> 
                    <select style="width:200px;font-family: cursive; " v-model="selected"> 
                        <option name="IDentifier" > IDentifier</option> 
                        <option name="Level"> Level </option> 
                        <option name="Program"> Program </option> 
                    </select> 
                    <form @submit.prevent="filter(selected,valueToSearch)" style="display:inline"> 
                        <input type ="text" v-model="valueToSearch" >
                    <button class ="btn badge-success" type="submit" >Go</button> 
                    <button class ="btn badge-success" @click.prevent="fetchStudents('')" >All</button> 
                    </form>

                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>IDentifier</th>
                                <th>E-mail</th>
                                <th>Date of birth</th>
                                <th>Level</th>
                                <th>Program</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tr v-for="student in students" v-bind:key="student.id">
                             <td>{{student.id}} </td>
                                <td>{{student.FirstName}} </td>
                                <td>{{student.LastName}}</td>
                                <td><router-link :to="`/StudentCourses/${student.Identifier}/${student.id}`">{{student.Identifier}}</router-link></td>
                                <td>{{student.Email}}</td>
                                <td>{{student.DateOfBirth}}</td>
                                <td>{{student.Level}}</td>
                                <td>{{student.Program}}</td>
                               <td> <button class="btn badge-success" @click="editStudent(student)">Edit</button> </td>
                               <td> <button class="btn badge-success" @click="deleteStudent(student.id)">Delete</button> </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <h4> Student</h4>
<form @submit.prevent="addStudent" class="md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="first name" v-model="student.FirstName" required>
                 <input type="text" class="form-control" placeholder="last name" v-model="student.LastName" required>
                <input type="text" class="form-control" placeholder="identifier" v-model="student.Identifier" required>
                 <input type="text" class="form-control" placeholder="email" v-model="student.Email" required>
                <input type="date" class="form-control" placeholder="date Of Birth" v-model="student.DateOfBirth" required>
                 <label>Level</label>
                <select placeholder=" Level" style="width:200px;font-family: cursive; " v-model="student.Level" required> 
                        <option name="1" > 1</option> 
                        <option name="2"> 2 </option> 
                        <option name="3"> 3 </option> 
                        <option name="4"> 4 </option> 
                </select> 
                <br>
                <label>Program</label>
                 <select style="width:200px;font-family: cursive; "  v-model="student.Program" required> 
                        <option v-for="program in programs" v-bind:key="program.id" name="1" > {{ program.Name}}</option> 
                </select> 
            </div>
            <!-- <button type="submit" class="btn badge-success">Save</button> -->
            <button type="submit" class="btn badge-success" v-show="editstudent"> Update</button>
            <button type="submit" class="btn badge-success" v-show="!editstudent">Add new Student</button>
        </form>
        <br><br>
       
</div>
</template>
<script>
  export default {
        data(){
            return{
                students:[],
                student:{
                    id:     '',
                    FirstName:  '',
                    LastName:   '',
                    Identifier: '',
                     Email:     '',
                    DateOfBirth:  '',
                    Level:   '',
                    Program: '',
                },    
                programs: [],
                program: {
                    id: '',
                    Name: '',
                    Description: '',
                },
                program_id: '',
                student_id: '',
                pagination: {},
                editstudent:       false,
                valueToSearch: '',
                selected:''
            }
        },
        created(){
            this.fetchStudents();
            this.fetchPrograms();
        },
        methods:{
            fetchStudents(page_url){
                page_url = page_url || '/api/students';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.students = res.data;
                    })
                    .catch(err => console.log(err));
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
            deleteStudent(id){
                if(confirm('Are You Sure?')){
                    fetch(`api/student/${id}`,{
                        method:'delete'
                    })
                        .then(res => res.json())
                        .then(data =>{
                            this.fetchStudents();
                        })
                        .catch(err => console.log(err))
                }
            },
            addStudent(){
                if(this.editstudent === false){
                    //Add
                    fetch('api/student',{
                        method:     'post',
                        body:       JSON.stringify(this.student),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                    this.student.FirstName=  '';
                    this.student.LastName=  '';
                    this.student.Identifier= '';
                     this.student.Email=     '';
                    this.student.DateOfBirth=  '';
                    this.student.Level=   '';
                    this.student.Program= '';
                            this.fetchStudents();
                        })
                        .catch(err => console.log(err));
                }else{
                    //Update
                    fetch('api/student',{
                        method:     'put',
                        body:       JSON.stringify(this.student),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                            
                this.student.id = '';
                this.student.student_id = '';
                    this.student.FirstName=  '';
                    this.student.LastName=  '';
                    this.student.Identifier= '';
                    this.student.Email=     '';
                    this.student.DateOfBirth=  '';
                    this.student.Level=   '';
                    this.student.Program= '';
                            this.fetchStudents();
                            this.editstudent=false;
                        })
                        .catch(err => console.log(err));
                }
            },
            editStudent(student){
                this.editstudent = true;
                this.student.id = student.id;
                this.student.student_id = student.id;
                     this.student.FirstName=  student.FirstName;
                    this.student.LastName=  student.LastName;
                    this.student.Identifier= student.Identifier;
                     this.student.Email=     student.Email;
                    this.student.DateOfBirth=  student.DateOfBirth;
                    this.student.Level=   student.Level;
                    this.student.Program= student.Program;
            },
            filter(selected,valueToSearch){
                fetch(`api/students/${selected}/${valueToSearch}`)
                    .then(res => res.json())
                    .then(res => {
                        this.students = res.data;
                    })
                    .catch(err => console.log(err));

            },
  },
        }
    
</script>
