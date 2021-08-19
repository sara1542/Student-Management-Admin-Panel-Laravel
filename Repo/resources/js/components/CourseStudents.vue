<template>
  <div>
    <h4>Students That have Been Enrolled in {{ courseCode }}</h4>
    <div class="row">
      <div class="col-lg-6">
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

  <table  ref="exportable_table" cellspacing="0" cellpadding="0" style="border-spacing:0;" id="QMSTable" class="mb-0 table table-bordered">
    <tr>
        <td class="divCenMid" colspan = "7"> Grades</td>
    </tr>

    <tr>
      <td class="allbdrCenMid">#</td>
      <td class="allbdrCenMid">Name</td>
      <td class="allbdrLtMid"> Identifier</td>
      <td class="allbdrCenMid"  v-for="item in items" v-bind:key="item.Name">{{ item.Name }} ( {{ item.Max }} )</td>
    </tr>

    <tr v-for="student in students" v-bind:key="student.FirstName">
                  <td class="allbdrCenMid">{{ student.id }}</td>
                  <td class="allbdrCenMid">{{ student.FirstName }} {{ student.LastName }}</td>
                  <td class="allbdrCenMid">{{ student.Identifier }}</td>
                  <template   v-for="grade in grades">
                  <td class="allbdrCenMid" v-bind:key="grade.id" v-if="grade.studentID === student.id"  >
                      <th v-show="false"> {{grade.Value}}</th>
                  <input type="text"  value=""  v-model="grade.Value" class="nobdrCenMid" style="overflow:hidden; "/>
                  </td>
                  </template>             
    </tr>
</table>
<button class="btn badge-success" @click="ExportExcel('xls')">Export Table to Excel </button>
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
      },
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
      pagination: {},
      student_id: '',
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
        })
        .catch((err) => console.log(err));
    },   
    fetchGrades(){
      fetch(`/api/grades/${this.id}`)
        .then(res => res.json())
        .then(res => {
          this.grades = res.data;
        })
        .catch((err) => console.log(err));
        console.log(this.grades);
    },
  },
  
};

</script>
