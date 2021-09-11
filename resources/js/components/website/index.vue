<template lang="">
    <div class="container">
        <div>
            <h2 class='mx-auto text-center my-5'>Basic Laravel Vue JS Form</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                <form @submit.prevent="createUser">

                    <div class="form-row">

                        <div class="col">
                            <label for="">Full Name</label>
                            <input type="text" name="name" v-model="form.name" id="" class="form-control"
                                placeholder="Enter Your Full Name">
                        </div>

                        <div class="col">
                            <label for="">Your Email</label>
                            <input type="email" name="email" v-model="form.email" class="form-control"
                                placeholder="Example@gmail.com">
                        </div>

                    </div>

                    <label class=' mb-2 mt-3'>Gander</label>
                    <div class="form-row">

                        <div class="col">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="form.gender" name="gender"
                                    id="exampleRadios1" value="male">
                                <label class="form-check-label" for="exampleRadios1">
                                    Male
                                </label>
                            </div>
                        </div>
                        <div class="col">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="form.gender" name="gender"
                                    id="exampleRadios2" value="female">
                                <label class="form-check-label" for="exampleRadios2">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <label class=' mb-2 mt-3 '>Image</label>
                    <div class="form-row">

                        <div class="col">
                            <input type="file" @change='onFileSelect' class="form-control" id="customFile">
                        </div>

                        <div class="col">
                            <img :src="form.photo" width="40px" height="40px" alt="">

                        </div>

                    </div>

                    <label class=' mb-2 mt-3 '>Skills</label>
                    <div class="form-row">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='form.skills' type="checkbox"
                                id="laravel" value="laravel">
                            <label class="form-check-label" for="laravel">Laravel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='form.skills' type="checkbox"
                                id="codeigniter" value="codeigniter">
                            <label class="form-check-label" for="codeigniter">Codeigniter</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='form.skills' type="checkbox"
                                id="ajax" value="ajax">
                            <label class="form-check-label" for="ajax">Ajax</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='form.skills' type="checkbox"
                                id="vuejs" value="vuejs">
                            <label class="form-check-label" for="vuejs">VUE JS</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='form.skills' type="checkbox"
                                id="mysql" value="mysql">
                            <label class="form-check-label" for="mysql">Mysql</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='form.skills' type="checkbox"
                                id="api" value="api">
                            <label class="form-check-label" for="api">API</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary  mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="row mt-5">
            <div class="col-lg-12 mx-auto">
                <h4 class="text-center">List Of Data</h4>
            </div>

            <div class="col-lg-10 mx-auto">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        <tr v-for='(user,index) in users' :key="index">
                            <td scope="row">{{index+1}}</td>
                            <td>
          <img :src="user.photo" alt="" width="60" height="60" class="img-fluid" />
                            </td>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.gender}}</td>
                            <td>
                                 <ul class="d-flex">

                                <li  @click="updateUser(user.id)" class='px-3 list-unstyled'><router-link to=""><em
                                            class="icon ni ni-repeat"></em><span>Edit</span></router-link>
                                </li>

                                <li @click="UserDelete(user.id)" class='px-3 list-unstyled'><router-link class='te' to="" ><em
                                            class="icon ni ni-trash"></em><span>Delete</span></router-link>
                                </li>

                            </ul>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
            <div class="col-lg-10 m-auto">
                <form @submit.prevent='UserUpdate' enctype="multipart/form-data">

                    <div class="form-row">

                        <div class="col">
                            <label for="">Full Name</label>
                            <input type="text" name="name" v-model="UserUpform.name" id="" class="form-control"
                                placeholder="Enter Your Full Name">
                        </div>

                        <div class="col">
                            <label for="">Your Email</label>
                            <input type="email" name="email" v-model="UserUpform.email" class="form-control"
                                placeholder="Example@gmail.com">
                        </div>

                    </div>

                    <label class=' mb-2 mt-3'>Gander</label>
                    <div class="form-row">

                        <div class="col">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="UserUpform.gender" name="gender"
                                    id="exampleRadios1" value="male">
                                <label class="form-check-label" for="exampleRadios1">
                                    Male
                                </label>
                            </div>
                        </div>
                        <div class="col">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="UserUpform.gender" name="gender"
                                    id="exampleRadios2" value="female">
                                <label class="form-check-label" for="exampleRadios2">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <label class=' mb-2 mt-3 '>Image</label>
                    <div class="form-row">

                        <div class="col">
                            <input type="file" @change='onFileSelect' class="form-control" id="customFile">
                        </div>

                        <div class="col">
                            <img :src="UserUpform.photo" width="40px" height="40px" alt="">

                        </div>

                    </div>

                    <label class=' mb-2 mt-3 '>Skills</label>
                    <div class="form-row">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='UserUpform.skills' type="checkbox"
                                id="laravel" value="laravel">
                            <label class="form-check-label" for="laravel">Laravel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='UserUpform.skills' type="checkbox"
                                id="codeigniter" value="codeigniter">
                            <label class="form-check-label" for="codeigniter">Codeigniter</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='UserUpform.skills' type="checkbox"
                                id="ajax" value="ajax">
                            <label class="form-check-label" for="ajax">Ajax</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='UserUpform.skills' type="checkbox"
                                id="vuejs" value="vuejs">
                            <label class="form-check-label" for="vuejs">VUE JS</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]'  v-model='UserUpform.skills' type="checkbox"
                                id="mysql" value="mysql">
                            <label class="form-check-label" for="mysql">Mysql</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name='skills[]' v-model='UserUpform.skills' type="checkbox"
                                id="api" value="api">
                            <label class="form-check-label" for="api">API</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary  mt-3">Submit</button>
                    </div>
                </form>
            </div>
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
                users: [],
                form: {
                    name: null,
                    email: null,
                    gender: null,
                    photo: null,
                    skills: [],

                },
                  UserUpform:{
                    id: '',
                  name: null,
                    email: null,
                    gender: null,
                    photo: null,
                    skills: [],
                }
            };
        },
        created() {
            this.getUsers();
        },
        methods: {
            updateUser(id){
                        $('#editmodel').modal('show');
                            let url='/api/edituser/'+id;
                axios.get(url)
                    .then((result) => {
                        this.UserUpform.id = result.data.user.id
                        this.UserUpform.name = result.data.user.name
                        this.UserUpform.email = result.data.user.email
                        this.UserUpform.gender = result.data.user.gender
                        this.UserUpform.photo = result.data.user.photo
                        this.UserUpform.skills = result.data.user.skills.split(',')

                    })

            },
                 UserUpdate(){
                let url='/api/updateuser';
    axios.post(url, this.UserUpform)
                    .then((result) => {
                        this.getUsers();
                        $('#editmodel').modal('hide')
                        // $(".modal-backdrop.fade.show").remove()
                           this.UserUpform.id = null
                        this.UserUpform.name = null
                        this.UserUpform.email =null
                        this.UserUpform.gender =null
                        this.UserUpform.photo = null
                        this.UserUpform.skills = null
                        if (result.data.success) {
                            Toast.fire({
                                icon: 'success',
                                title: result.data.success
                            })
                        }

                    })
            },
            UserDelete(id){
                let url='/api/deleteuser/'+id;
axios.delete(url)
.then(res => {
       Toast.fire({
                            icon: 'success',
                            title: res.data.success
                        });
       this.users=this.users.filter(res=>{
         return res.id != id
     })
})
            },
            getUsers() {
                axios
                    .get("/api/users")
                    .then((res) => {
                        this.users = res.data.data;
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            },
            createUser() {

                axios.post('/api/users', this.form)
                    .then((res) => {
                        console.log(res.data);
                        this.getUsers();
  this.form.name = "",
                        this.form.email = "",
                        this.form.gender = "",
                        this.form.skills = "",
                        this.form.photo = "",
                        Toast.fire({
                            icon: 'success',
                            title: res.data.success
                        })



                    })
            },

            onFileSelect(event) {
                let file = event.target.files[0];

                if (file.size > 1048770) {
                    notification.Image_size()
                } else {
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.photo = event.target.result
                        this.UserUpform.photo = event.target.result
                        console.log(event.target.result);

                    };
                    reader.readAsDataURL(file);
                }
            },
        }

    }

</script>
<style lang="">

</style>
