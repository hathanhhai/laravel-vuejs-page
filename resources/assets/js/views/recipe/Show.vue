<template>

<div class="container">

    <div class="row">
        <div class="col-sm-6">
            <img width="300" height="300" :src="`/images/${recipe.image}`" v-if="recipe.image"/>
        </div>
        <div class="col-sm-6">
            <h2>{{recipe.name}}</h2>
            <small class="small">Create by:{{recipe.user.name}}</small>
            <p>{{recipe.description}}</p>

            <div v-if="auth.api_token && auth.user_id ==recipe.user_id">
        {{auth.user_id}}
        {{recipe.user_id}}
                <router-link :to="`/recipe/${recipe.id}/edit`" class="btn btn-primary"> edit</router-link>

                <button class="btn btn-danger" @click="remove()">Delete</button>

            </div>

        </div>
    </div>
    <div class="row">

        <div class="col-sm-6">
            <h2>Recipe ingreients</h2>
            <ul>
                <li v-for="item in recipe.ingredients">
                    <span>{{item.name}}</span>
                    <span>{{item.qty}}</span>
                </li>
            </ul>

        </div>
        <div class="col-sm-6">
            <h2>Recipe directions</h2>
            <ul>
                <li v-for="(item,key) in recipe.directions">
                    <p>
                        <strong>{{key+1}}</strong>
                        {{item.desciption}}
                    </p>

                </li>
            </ul>

        </div>

    </div>


</div>


</template>

<script type="text/javascript">

    import Auth from '../../store/authen';
    import {del,get} from '../../helpers/api';
    import Flash from '../../helpers/flash';

    export default {
        data(){
            return {
                auth :Auth.state,
                isRemoving:false,
                recipe:{
                    user:{},
                    ingredients:[],
                    directions:[]

                }
            }
        },created(){
            get(`/api/recipe/${this.$route.params.id}`).then((res)=>{
                this.recipe = res.data.recipe
            })
        },methods:{
            remove(){
                this.isRemoving = false;
                del(`/api/recipe/${this.$route.params.id}`).then((res)=>{
                    if(res.data.delete){
                        Flash.setSuccess("Deleted Successfully");
                        this.$router.push('/')
                    }
                })
            }
        }
    }

</script>

