<template>
  <div>
    <h4>Courses in {{Name}} Program</h4>
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
      Name: this.$route.params.Name,
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
      page_url = page_url || "/api/programs/" + this.Name;
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
 

  },
};
</script>
