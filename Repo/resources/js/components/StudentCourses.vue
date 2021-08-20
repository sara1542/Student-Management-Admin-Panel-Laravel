<template>
    <div>
      <form @submit.prevent="saveGrades" class="md-3">
        <h4>Courses That {{studentID}} has Enrolled in</h4>
        <div class="row">
                 <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Courses</h5>
                            <table class="mb-0 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                    </tr>
                                </thead>
                                <tr v-for="course in courses" v-bind:key="course.Name">
                                        <td>{{course.Name}}</td>
                                        <td>{{course.Code}}</td>
                                        <template   v-for="grade in grades">
                              <td class="allbdrCenMid" v-bind:key="grade.id" v-if="grade.courseID === course.id"  >
                              <th> {{grade.Name}}/ {{grade.Max}}</th> 
                                <input type="number"  value=""  v-model="grade.Value" class="nobdrCenMid" style="overflow:hidden; " min="0" :max='grade.Max' required>
                                </td>
                                </template>
                                <template>
                                <th style="text-align: center; vertical-align: middle;">Total: {{ course.totalValue }} / {{course.totalMax}} </th>  
                                </template>
                                </tr> 
                            </table>
                            
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn badge-success" >Save</button>
                </form>
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
        totalValue:0,
        totalMax:0,
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
      items: [],
      item: {
        id:'',
        courseID: '',
        Name:'',
        Description: '',
        Max: '',
      },
      item_id:'',
      boolShow: false,
    };
  },
  created() {
    this.fetchCourses();
    this.fetchGrades();
    this.fetchTotalValues();
  },
  methods: {
    fetchCourses(page_url) {
      page_url = page_url || '/api/courses/'+this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.courses = res.data;
        })
        .catch((err) => console.log(err));
    },
    fetchGrades(){
          this.totalValue=0;
          this.totalMax=0;
      fetch(`/api/gradesPerStudent/${this.id}`)
        .then(res => res.json())
        .then(res => {
          this.grades = res.data;
          this.fetchTotalValues();
        })
        .catch((err) => console.log(err));

    },
    fetchTotalValues(){
      var sum1=0,sum2=0,i=0;
        this.courses.forEach(course=>{
            sum1=0,sum2=0;
             this.grades.forEach(grade=>{
             if(course.id==grade.courseID){
               sum1+=grade.Value;
               sum2+=grade.Max;
             }   
          }) 
          course.totalValue=sum1;
          course.totalMax=sum2;
          })     
    },
     saveGrades(){
  this.grades.forEach(item=>{
             this.grade.grade_id = item['id'];
                        this.grade.id =item['id'];
                        this.grade.Name=  item['Name'];
                        this.grade.Value= item['Value'];
                        this.grade.Max= item['Max'];
                            this.grade.studentID=  item['studentID'];
                        this.grade.courseID= item['courseID'];
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
                                })
                                .catch(err => console.log(err));
          })
      this.fetchGrades();         
    }
  },
};
</script>
