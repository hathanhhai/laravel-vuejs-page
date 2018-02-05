<template>

        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel-default">
                        <h3>{{action}} Recipe</h3>
                        <button class="btn btn-primary pull-right" @click="save" >Save</button>
                        <button class="btn btn-default pull-right" @click="$router.back()">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">

                    <ImageUpload v-model="form.image"></ImageUpload>
                </div>

                <div class="col-sm-9">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" v-model="form.name" />
                        <p style="color:red" v-if="errors.name">{{errors.name[0]}}</p>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" type="text" v-model="form.description" ></textarea>
                        <p style="color:red" v-if="errors.description">{{errors.description[0]}}</p>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                <table class="table table-striped">
                    <thead>
                        <th>Name</th>
                        <th>Ingredients</th>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in form.ingredients">
                            <td>
                                <input type="text" class="form-control" v-model="item.name" :class="[errors[`ingredients.${index}.name ?'alert alert-danger':''`]]"/>

                            </td>
                            <td>
                                <input type="text" class="form-control" v-model="item.qty" :class="[errors[`ingredients.${index}.qty ?'alert alert-danger':''`]]"/>
                            </td>
                            <td><button class="btn btn-danger" @click="removeIngredients(item,index)">Remove</button></td>
                        </tr>
                    </tbody>
                 <tfoot>
                    <tr>
                        <td><button class="btn btn-success" @click="addingredient">Add Ingredients</button></td>
                    </tr>
                 </tfoot>
                </table>
                </div>

                <div class="col-sm-6">
                    <table class="table table-striped">
                        <thead>
                        <th>Description</th>
                        <th></th>
                        </thead>
                        <tbody>
                        <tr v-for="(item,index) in form.directions">

                            <td>
                                <textarea class="form-control" v-model="item.description" :class="[errors[`directions.${index}.qty ?'alert alert-danger':''`]]">

                                </textarea>
                            </td>
                            <td><button class="btn btn-danger" @click="removeDirection(item)">Remove</button></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><button class="btn btn-success" @click="adddirection">Add Direction</button></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
</template>

<script type="text/javascript">

    import Vue from 'vue';
    import flash from '../../helpers/flash'
    import {get,post} from '../../helpers/api';
    import ImageUpload from '../../components/ImgeUpload';

    export default {
        components:{
            ImageUpload
        },
        data(){
            return{
                form:{
                    ingredients:[],
                    directions:[],

                }
                ,errors:{},
                initializeURL:'/api/recipe/create',
                storeURL:`api/recipe`,
                action:'create'

            }
        },created(){
            if(this.$route.meta.mode ==='edit'){
                this.initializeURL = `/api/recipe/${this.$route.params.id}/edit`
                this.storeURL = `/api/recipe/${this.$route.params.id}?_method=PUT`
                this.action = 'update'
            }
            get(this.initializeURL).then((res)=>{
                this.form = res.data.form;
                console.log(this.form);
            })
        },methods:{
            save(){

            },
            addingredient(){
                this.form.ingredients.push({name:'',qty:''});
            },adddirection(){
                this.form.directions.push({description:''});
            },removeDirection(type){

                    this.form.directions.splice(type,1);

            },removeIngredients(type){
                this.form.ingredients.splice(type,1);
            }
        }
    }

</script>
