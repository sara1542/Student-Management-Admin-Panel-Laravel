<template>
    <div>
<link href="/css/main.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Programs</h5>

                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th> Courses</th>
                                   <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tr>
                        <tr v-for="program in programs" v-bind:key="program.id">
                                <th>{{program.id}}</th>
                                <td>{{program.Name}}</td>
                                <td>{{program.Description}}</td> 
                                <td><router-link :to="`/ProgramCourses/${program.Name}`">Go to {{program.Name}} Courses =></router-link></td>
                                <td> <button class="btn badge-success" @click="editProgram(program)">Edit</button> </td>
                               <td> <button class="btn badge-success" @click="deleteProgram(program.id)">Delete</button> </td>
                          </tr>
                          
                    </table>
                </div>
            </div>
        </div>
    </div>
<form @submit.prevent="addProgram" class="md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="name" v-model="program.Name" required>
                 <input type="text" class="form-control" placeholder="Description" v-model="program.Description" required>
            </div>
            <button type="submit" class="btn badge-success" v-show="editprogram" >Update</button>
            <button type="submit" class="btn badge-success" v-show="!editprogram" >Add new Program</button>
            
        </form>
        <br><br>  
        </div>
</template>
<script>
  export default {
        data(){
            return{
                programs: [],
                program: {
                    id: '',
                    Name: '',
                    Description: '',
                },
                program_id: '',
                pagination: {},
                editprogram:       false,
                valueToSearch: '',
                selected:''
            }
        },
        created(){
            this.fetchPrograms();
        },
        methods:{
            fetchPrograms(page_url) {
                page_url = page_url || '/api/programs';
                fetch(page_url)
                    .then((res) => res.json())
                    .then((res) => {
                    this.programs = res.data;
                    })
                    .catch((err) => console.log(err));
                },
            deleteProgram(id){
                        if(confirm('Are You Sure?')){
                            fetch(`api/program/${id}`,{
                                method:'delete'
                            })
                                .then(res => res.json())
                                .then(data =>{
                                    this.fetchPrograms();
                                })
                                .catch(err => console.log(err))
                        }
                    },
            addProgram(){
                
                console.log(this.editprogram);
                        if(this.editprogram === false){
                            
                            console.log('In add');
                            //Add
                            fetch(`/api/program`,{
                                method:     'post',
                                body:       JSON.stringify(this.program),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                            this.program.Name=  '';
                            this.program.Description= '';
                                    this.fetchPrograms();
                                })
                                .catch(err => console.log(err));
                        }else{
                            console.log('In update');
                            //Update
                            fetch('/api/program',{
                                method:     'put',
                                body:       JSON.stringify(this.program),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                                     this.program.id = '';
                            this.program.program_id = '';
                            this.program.Name=  '';
                            this.program.Description= '';
                                    this.fetchPrograms();
                                    this.editprogram=false;
                                })
                                .catch(err => console.log(err));
                        }
                    },
            editProgram(program){
                        this.editprogram = true;
                        this.program.program_id = program.id;
                        this.program.id = program.id;
                        this.program.Name=  program.Name;
                        this.program.Description= program.Description;
                    },
            filterprogram(selected,valueToSearch){
                        let vm = this; 
                        fetch(`api/programs/${selected}/${valueToSearch}`)
                            .then(res => res.json())
                            .then(res => {
                                this.courses = res.data;
                                vm.makePagination(res.meta, res.links);
                            })
                            .catch(err => console.log(err));

                    }
  },
        }
    
</script>
