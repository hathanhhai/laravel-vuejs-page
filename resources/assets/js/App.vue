<template>
    <div class="container">
        <br>

        <nav class="navbar navbar-default">

            <div class="container">
                <div class="navbar-brand">
                    <router-link to="/">Recipe Box</router-link>
                </div>
                <ul class="nav navbar-nav pull-right" style="margin-right: 10px;">
                    <li v-if="!check"><router-link to="/login">LOGIN</router-link></li>
                    <li v-if="!check"><router-link to="/register">REGISTER</router-link></li>
                    <li v-if="check"><a @click="logout">LOGOUT</a></li>

                </ul>

            </div>

        </nav>
        <div class="alert alert-success" v-if="flash.success">{{flash.success}}</div>
        <div class="alert alert-danger" v-if="flash.error">{{flash.error}}</div>
        <router-view></router-view>
    </div>

</template>
<script type="text/javascript">
        import Flash from './helpers/flash';
        import Auth from './store/authen';
        import {post} from './helpers/api';
    export default {
        created(){
            Auth.initialize();
        },
        data(){
            return {
                flash:Flash.state,
                auth:Auth.state
            }
        },
        computed:{
            check(){
                if(this.auth.api_token && this.auth.user_id){
                    return true;
                }
                return false;
            }
        },methods:{
            logout(){
                post('api/logout')
                    .then((res)=>{
                        if(res.data.logged_out){
                            Auth.remove();
                            Flash.setSuccess('You have successfully logout');
                            this.$router.push('/')
                        }
                    }).catch((err)=>{
                        if(err.res.status === 401){
                            Flash.setError('You logged out');
                            this.$router.push('/')
                        }

                })
            }
        }
    }

</script>