<template>
    <div>
<link href="/css/main.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Levels</h5>

                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th> Courses</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>1</td>
                            <td>Level 1</td>
                            <td>test</td>
                               <td><router-link :to="`/LevelCourses/1`">Go to Level 1 Courses =></router-link></td>
                          </tr>
                           <tr>
                            <td>2</td>
                            <td>Level 2</td>
                            <td>test</td>
                                <td><router-link :to="`/LevelCourses/2`">Go to Level 2 Courses =></router-link></td>
                         </tr>
                           <tr>
                            <td>3</td>
                            <td>Level 3</td>
                            <td>test</td>
                               <td><router-link :to="`/LevelCourses/3`">Go to Level 3 Courses =></router-link></td>
                          </tr>
                           <tr>
                            <td>4</td>
                            <td>Level 4</td>
                            <td>test</td>
                                  <td><router-link :to="`/LevelCourses/4`">Go to Level 4 Courses =></router-link></td>
                          </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
        </div>
   
</template>
