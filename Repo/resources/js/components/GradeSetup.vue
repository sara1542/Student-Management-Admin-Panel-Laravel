<template>
    <div>
<link href="/css/main.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Items {{courseIDD}}</h5>

                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th> courseID</th>
                                <th>Name</th>
                                <th>Max</th>
                                <th> Description</th>
                                <th> Edit</th>
                                <th> Delete</th>
                            </tr>
                            <tr v-for="Item in Items" v-bind:key="Item.Name">
                                <th>{{ Item.courseID }}</th>
                                <th>{{ Item.Name }}</th>
                                <th>{{ Item.Max }}</th>
                                <th>{{ Item.Description }}</th>
                                <td> <button class="btn badge-success" @click="editItem(Item)">Edit</button> </td>
                               <td> <button class="btn badge-success" @click="deleteItem(Item.courseID,Item.Name)">Delete</button> </td>
                                
                            </tr>
                        </thead>
                          
                    </table>
                </div>
            </div>
        </div>
    </div>
<form @submit.prevent="addItem" class="md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="name" v-show="!edititem" v-model="Item.Name" required>
                <input type="text" class="form-control" placeholder="Max" v-model="Item.Max" required>
                 <input type="text" class="form-control" placeholder="Description" v-model="Item.Description" required>  
            </div>
            <button type="submit" class="btn badge-success" v-show="edititem" >Update</button>
            <button type="submit" class="btn badge-success" v-show="!edititem" >Add new Item</button>
            
        </form>
        <br><br>  
       
        </div>
</template>
<script>
  export default {
        data(){
            return{
                courseIDD: this.$route.params.courseIDD,
                Items: [],
                Item: {
                    id:'',
                    courseID:'',
                    Name: '',
                    Description: '',
                    Max: '',
                    
                },
                pagination: {},
                item_id:'',
                edititem:       false
            }
        },
        created(){
            this.fetchItems();
        },
        methods:{
            fetchItems(page_url) {
                let vm = this;
                page_url = page_url || '/api/Items/'+this.courseIDD;
                fetch(page_url)
                    .then((res) => res.json())
                    .then((res) => {
                    this.Items = res.data;
                    })
                    .catch((err) => console.log(err));
                },
            deleteItem(courseID,Name){
                        if(confirm('Are You Sure?')){
                            fetch(`/api/item/${courseID}/${Name}`,{
                                method:'delete'
                            })
                                .then(res => res.json())
                                .then(data =>{
                                    this.fetchItems();
                                })
                                .catch(err => console.log(err))
                        }
                    },
            addItem(){
                console.log(this.edititem);
                this.Item.courseID=this.courseIDD;
                        if(this.edititem === false){
                            
                            console.log('In add');
                            //Add
                            fetch(`/api/item`,{
                                method:     'post',
                                body:       JSON.stringify(this.Item),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                                    this.Item.id='',
                                    this.Item.courseID='';
                                    this.Item.Name=  '';
                                    this.Item.Max=  '';
                                    this.Item.Description= '';
                                    this.fetchItems();
                                })
                                .catch(err => console.log(err));
                        }else{
                            console.log('In update');
                            //Update
                            fetch('/api/item',{
                                method:     'put',
                                body:       JSON.stringify(this.Item),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                                      this.Item.id = '';
                                 this.Item.item_id = '';
                                this.Item.courseID='';
                                this.Item.Name=  '';
                                this.Item.Max=  '';
                                this.Item.Description= '';
                                    this.fetchItems();
                                    this.edititem=false;
                                })
                                .catch(err => console.log(err));
                        }
                        
                        
                    },
            editItem(Item){
                        this.edititem = true;
                        this.Item.id=Item.id;
                        this.Item.item_id = Item.id;
                        this.Item.courseID = Item.courseID;
                        this.Item.Name=  Item.Name;
                        this.Item.Max=  Item.Max;
                        this.Item.Description= Item.Description;
                    },
  },
        }
    
   
</script>
