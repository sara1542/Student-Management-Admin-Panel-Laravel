<template>
    <div>
        <h4>Courses That {{studentID}} has Enrolled in</h4>
        <div class="row">
                <div class="col-lg-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Courses</h5>

                            <table class="mb-0 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tr v-for="course in courses" v-bind:key="course.Name">
                                        <th>{{course.Name}}</th>
                                        <th>{{course.Code}}</th>
                                        <th><button class="btn badge-success"  @click="fetchGrades(course.id)">Show grade </button></th>
                                </tr>
                            </table>
                            <div v-show="boolShow">
                              <table class="mb-0 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Max</th>
                                    </tr>
                                </thead>
                                <tr v-for="grade in grades" v-bind:key="grade.Name">
                                        <th>{{grade.Name}}</th>
                                          <th>
                                             <form  @submit.prevent="saveGradeValue(grade)">
                                            <input type="number" v-model="grade.Value" min="0" :max='grade.Max'>
                                        <button class ="btn badge-success" type="submit">Save</button>
                                        </form>
                                        </th>                                       
                                        <th>{{grade.Max}}</th>
                                </tr>
                                <tr>
                                  <th>Total</th>
                                  <th>{{totalValue}}</th>
                                  <th>{{totalMax}}</th>
                                </tr>
                            </table>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      studentID: this.$route.params.studentID,
      id:this.$route.params.id,
      courses: [],
      course: {
        id: '',
        Name: '',
        Code: '',
        Description: '',
      },
      grades: [],
      grade: {
        id:'',
        courseID: '',
        studentID: '',
        Name:'',
        Value: '',
        Max: '',
      },
      grade_id:'',
      totalValue:0,
      totalMax:0,
      pagination: {},
      boolShow: false,
    };
  },
  created() {
    this.fetchStudents();
  },
  methods: {
    fetchStudents(page_url) {
      page_url = page_url || '/api/courses/'+this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.courses = res.data;
        })
        .catch((err) => console.log(err));
    },
    fetchGrades(courseid){
          this.totalValue=0;
          this.totalMax=0;
      this.boolShow = true;
      fetch(`/api/grades/${this.id}/${courseid}`)
        .then(res => res.json())
        .then(res => {
          this.grades = res.data;

          this.grades.forEach(item=>{
            for(let g in item){
              this.totalValue+= item['Value'];
              this.totalMax+=item['Max'];
              break;
            }
          })
        })
        .catch((err) => console.log(err));

    },
    saveGradeValue(grade){
      console.log('In update');
       this.grade.grade_id = grade.id;
                        this.grade.id = grade.id;
                        this.grade.Name=  grade.Name;
                        this.grade.Value=  grade.Value;
                        this.grade.Max=  grade.Max;
                            this.grade.studentID=  grade.studentID;
                        this.grade.courseID= grade.courseID;
                            //Update
                            fetch('/api/grade',{
                                method:     'put',
                                body:       JSON.stringify(this.grade),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                                     this.grade.id = '';
                            this.grade.grade_id = '';
                            this.grade.courseID='';
                            this.grade.studentID='';
                            this.grade.Name=  '';
                            this.grade.Max=  '';
                            this.grade.Value=  '';
                              this.totalValue=0;
                              this.totalMax=0;
                                    this.fetchGrades();
                                })
                                .catch(err => console.log(err));

    }
  },
};
</script>
