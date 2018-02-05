<template>
   <div>
      <form class="form-group" v-cloak @submit.prevent="register">
         <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">

               <div class="form-group">

                  <input placeholder="Input your named" class="form-control" v-model="form.name" type="text" />
                  <span v-if="errors.name" style="color:red">{{errors.name[0]}}</span>
               </div>

               <div class="form-group">
                  <input placeholder="Input your email" class="form-control" v-model="form.email" type="text" />
                  <span v-if="errors.email" style="color:red">{{errors.email[0]}}</span>
               </div>

               <div class="form-group">
                  <input placeholder="Input your password" class="form-control" v-model="form.password" type="password" />
                  <span v-if="errors.password" style="color:red">{{errors.password[0]}}</span>
               </div>

               <div class="form-group">
                  <input placeholder="Confirm you password" type="password" class="form-control"  v-model="form.password_confirmation">

               </div>

               <div class="form-group">
                  <button  class="btn btn-success">Register</button>
               </div>
            </div>
            <div class="col-sm-4"></div>
         </div>
      </form>
   </div>

</template>

<script type="text/javascript">
      import Flash from '../../helpers/flash';
      import {post} from '../../helpers/api';
   export default {

       data(){
           return {
               form: {
                   name: '',
                   email: '',
                   password: '',
                   password_confirmation: ''
               },
               errors: {},
               isProcessing: false
           }
       },
       methods:{

           register(){
               this.isProcessing = true;
               this.errors ={};
               post('api/register', this.form)
                   .then((res)=>{
                        if(res.data.registered){
                            Flash.setSuccess("You created account successfully ");
                            this.$router.push('/login');
                        }
                   }).catch((err)=>{
                   Flash.setError('Some thing wrong ...');
                        if(err.response.status === 422){
                           this.errors = err.response.data.errors;
                        }

                  });


           }

       }
   }

</script>
