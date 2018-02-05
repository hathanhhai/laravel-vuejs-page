<template>

    <div class="container">
        <div class="row" >
                        <div v-for="item in recipes" class="col-sm-4" style="min-width:300px;min-height: 200px" >
                            <router-link :to="`/recipe/${item.id}`">
                            <div class="thumbnail" >
                                <p ><strong>{{item.name}}</strong></p>
                                <img :src="`/images/${item.image}`" v-if="item.image">
                                <button class="btn">Buy Tickets</button>
                            </div></router-link>
                        </div>
            </div>





    </div>


</template>

<script>
    import {get} from '../../helpers/api';

    export default {
        data(){
            return {
                recipes:{}
            }
        },
        created(){
            get('/api/recipe').then((res)=>{
                this.recipes = res.data.recipes;
            })
        }

    }

</script>
