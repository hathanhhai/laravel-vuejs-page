<template>

<div class="image" v-if="image">


    <img width="200" height="200" :src="image"/>
        <button class="btn btn-danger" @click="$emit('close')">close</button>
</div>

</template>

<script>
    export default {
        props:{
            preview:{
                type:[String,File],
                default:null
            }
        },data(){
            return{
                image:null
            }
        },created(){
            this.setPreview()
        },watch:{
            'preview':'setPreview'
        },methods:{

            setPreview(){
                if(this.preview instanceof File){
                    const fileReder  =new FileReader();
                    fileReder.onload= (event)=>{
                        this.image = event.target.result
                    }
                    fileReder.readAsDataURL(this.preview);
                }else if (typeof this.preview === 'string'){
                    this.image = `/images/${this.preview}`;
                }else{
                    this.image  = null;
                }
            }

        }
    }
</script>

<style scoped>

</style>