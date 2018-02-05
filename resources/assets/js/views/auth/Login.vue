<template>
    <div>
        <form class="form-group" v-cloak @submit.prevent="login">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                        <br>
                    <h1>Welcome black !!!</h1>             <br>
                    <div class="form-group">

                        <input placeholder="Input your email" class="form-control" v-model="form.email" type="text" />
                        <span v-if="errors.email" style="color:red">{{errors.email[0]}}</span>
                    </div>

                    <div class="form-group">
                        <input placeholder="Input your password" class="form-control" v-model="form.password" type="password" />
                        <span v-if="errors.password" style="color:red">{{errors.password[0]}}</span>
                    </div>


                    <div class="form-group">
                        <button  class="btn btn-success">Login</button>
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
    import Auth from '../../store/authen';
    export default {

        data(){
            return {
                form: {
                    email: '',
                    password: '',
                },
                errors: {},
                isProcessing: false
            }
        },
        methods:{

            login(){
                this.isProcessing = true;
                this.errors ={};
                post('api/login', this.form)
                    .then((res)=>{
                        if(res.data.authenticated){
                            Auth.set(res.data.api_token,res.data.user_id);
                            Flash.setSuccess("You are login successfully ");
                            this.$router.push('/');
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
