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
                            <th>1</th>
                            <td>Level 1</td>
                            <td>test</td>
                               <td><router-link :to="`/LevelCourses/1`">Go to Level 1 Courses =></router-link></td>
                          </tr>
                           <tr>
                            <th>2</th>
                            <td>Level 2</td>
                            <td>test</td>
                                <td><router-link :to="`/LevelCourses/2`">Go to Level 2 Courses =></router-link></td>
                         </tr>
                           <tr>
                            <th>3</th>
                            <td>Level 3</td>
                            <td>test</td>
                               <td><router-link :to="`/LevelCourses/3`">Go to Level 3 Courses =></router-link></td>
                          </tr>
                           <tr>
                            <th>4</th>
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
