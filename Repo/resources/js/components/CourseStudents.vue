<template>
  <div>
    <h4>Students That have Been Enrolled in {{ courseCode }}</h4>
    <div class="row">
        <div class="main-card mb-3 card">
          <div class="card-body">

            <table class="mb-0 table table-bordered">
              <thead>
                <tr>
                  <th> #</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Identifier</th>
                  <th>E-mail</th>
                </tr>
              </thead>
              <tr v-for="student in students" v-bind:key="student.FirstName">
                <td>{{ student.id }}</td>
                <td>{{ student.FirstName }}</td>
                <td>{{ student.LastName }}</td>
                <td>{{ student.Identifier }}</td>
                <td>{{ student.Email }}</td>
              </tr>
            </table>
          </div>
        </div>
  
    </div>

    <h4>Students That haven't Enrolled in {{ courseCode }}</h4>
    <div class="row">
      <div class="col-lg-8">
        <div class="main-card mb-5 card">
          <div class="card-body">
            <table class="mb-0 table table-bordered">
              <thead>
                <tr>
                  <th> #</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Identifier</th>
                  <th>E-mail</th>
                  <th>Enroll</th>
                </tr>
              </thead>
              <tr v-for="student in students2" v-bind:key="student.FirstName">
                <td>{{ student.id }}</td>
                <td>{{ student.FirstName }}</td>
                <td>{{ student.LastName }}</td>
                <td>{{ student.Identifier }}</td>
                <td>{{ student.Email }}</td>
                <td> <button class="btn badge-success" @click="Enroll(student)">Enroll</button> </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
<form @submit.prevent="saveGrades" class="md-3">
  <table  ref="exportable_table" cellspacing="0" cellpadding="0" style="border-spacing:0;" id="QMSTable" class="mb-0 table table-bordered">
    <tr>
        <td class="divCenMid" colspan = "7"> Grades</td>
    </tr>

    <tr>
      <th class="allbdrCenMid">#</th>
      <th class="allbdrCenMid">Name</th>
      <th class="allbdrLtMid"> Identifier</th>
      <th class="allbdrCenMid"  v-for="item in items" v-bind:key="item.Name">{{ item.Name }} ( {{ item.Max }} )</th>
     <th class="allbdrCenMid">Total ( {{totalMax}})</th>
    </tr>

    <tr v-for="student in students" v-bind:key="student.FirstName">
                  <td class="allbdrCenMid">{{ student.id }}</td>
                  <td class="allbdrCenMid">{{ student.FirstName }} {{ student.LastName }}</td>
                  <td class="allbdrCenMid">{{ student.Identifier }}</td>
                  <template   v-for="grade in grades">
                  <td class="allbdrCenMid" v-bind:key="grade.id" v-if="grade.studentID === student.id"  >
                <th v-show="false"> {{grade.Value}}</th> 
                  <input type="number"  value=""  v-model="grade.Value" class="nobdrCenMid" style="overflow:hidden; " min="0" :max='grade.Max' required>
                  </td>
                  </template> 
                   <td class="allbdrCenMid">{{ student.totalValue }}</td>           
    </tr>
</table>
<br>
<button type="submit" class="btn badge-success" >Save</button>
<button class="btn badge-success" @click="ExportExcel('xls')">Export Table to Excel </button>
</form>
</div>
</template>
<script>
export default {
  data() {
    return {
      courseCode: this.$route.params.courseCode,
      id: this.$route.params.id,
      exportData:[],
      exportData:{
        id:'',
        FirstName: '',
        LastName: '',
        Identifier: '',
        grade:''
      },
      students: [],
      student: {
        id: '',
        FirstName: '',
        LastName: '',
        Identifier: '',
        Email: '',
        DateOfBirth:  '',
        Level:   '',
        Program: '',
        totalValue:0,
      },
      student_id: '',
       students2: [],
      student2: {
        id: '',
        FirstName: '',
        LastName: '',
        Identifier: '',
        Email: '',
        DateOfBirth:  '',
        Level:   '',
        Program: '',
      },
      enroll:{
        student:'',
        course:''
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
       items: [],
      item: {
        id:'',
        courseID: '',
        Name:'',
        Description: '',
        Max: '',
      },
      item_id:'',
      totalMax:0,
    };
  },
  created() {
    this.fetchStudents();
    this.fetchStudents2();
    this.fetchItems();
     this.fetchGrades();
  },
  methods: {
    ExportExcel(type, fn, dl) {
      var elt = this.$refs.exportable_table;
      var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
      return dl ?
        XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
      XLSX.writeFile(wb, fn || (('grades'+ '.'|| 'SheetJSTableExport.') + (type || 'xlsx')));
      
    },
    fetchStudents(page_url) {
      page_url = page_url || "/api/students/" + this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.students = res.data;
        })
        .catch((err) => console.log(err));
    },
    fetchStudents2(page_url) {
      page_url = page_url || "/api/students2/" + this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.students2 = res.data;
        })
        .catch((err) => console.log(err));
    },
addStudent(){
                    //Add
                    fetch('/api/studentEnroll',{
                        method:     'post',
                        body:       JSON.stringify(this.enroll),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                    this.enroll.student=  '';
                    this.enroll.course=  '';
                            this.fetchStudents();
                            this.fetchStudents2();
                            this.fetchGrades();
                        })
                        .catch(err => console.log(err));
                
            },
    Enroll(student){
                this.enroll.student = student.id;
                this.enroll.course = this.id;
                this.addStudent();
            },
    fetchItems(page_url) {
      page_url = page_url || "/api/Items/"+this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.items = res.data;
          //calculate total max
          this.items.forEach(item=>{
              this.totalMax+=item['Max'];
          })

        })
        .catch((err) => console.log(err));
    },   
    fetchGrades(){
      fetch(`/api/gradesPerCourse/${this.id}`)
        .then(res => res.json())
        .then(res => {
          this.grades = res.data;
          this.fetchTotalValues();
        })
        .catch((err) => console.log(err));
        
    },
    fetchTotalValues(){
      //number of items
      var num=this.items.length;
      var sum=0,i=0;
        this.students.forEach(student=>{
            sum=0;
             this.grades.forEach(grade=>{
             if(student.id==grade.studentID){
               sum+=grade.Value;
             }   
          }) 
          student.totalValue=sum;
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
