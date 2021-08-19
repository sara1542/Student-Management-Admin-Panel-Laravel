<template>
  <div>
    <h4>Courses in Level {{id}}</h4>
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
                </tr>
              </thead>
              <tr v-for="course in courses" v-bind:key="course.Name">
                <th>{{ course.Name }}</th>
                <th>{{ course.Code }}</th>
              </tr>
            </table>
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
      courseId: this.$route.params.id,
       courses: [],
                course: {
                    id: '',
                    Name: '',
                    Code: '',
                    Description: '',
                    Level: '',
                    Program: '',
                },
       course_id: '',
      pagination: {},
      
    };
  },
  created() {
    this.fetchCourses();
  },
  methods: {
    fetchCourses(page_url) {
      let vm = this;
      page_url = page_url || "/api/levels/" + this.courseId;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.courses = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch((err) => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };
      this.pagination = pagination;
    },
    addCourse(){
      
                            console.log(this.course_id+ "vvv"+this.course.id)
      fetch(`/api/course`,{
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
                            this.course.Description= '';
                            this.course.Level=  '';
                            this.course.Program=  '';
                                     this.fetchCourses();
                                })
                                .catch(err => console.log(err));  
    },
    addCourse0() {
      fetch(`/api/coursePerLevel`, {
        method: 'post',
        body: JSON.stringify(this.item),
        headers: {
          "content-type": "application/json",
        },
      })
        .then((res) => res.json())
        .then((data) => {
            this.item.level="";
            this.item.course="";
          this.fetchCourses();
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>
