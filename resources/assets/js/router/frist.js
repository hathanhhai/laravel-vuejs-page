import Vue from 'vue'
import VueRouter from 'vue-router'


import Register from '../views/auth/Register.vue'
import Login from '../views/auth/Login.vue'
import RecipeIndex from '../views/recipe/Index';
import RecipeShow from '../views/recipe/Show';
import RecipeForm from '../views/recipe/form';

Vue.use(VueRouter);
const router = new VueRouter({

	routes: [

		{ path: '/recipe', component: Register },
		{ path: '/recipe/:id/edit', component: RecipeForm,meta:{mode:'edit'} },
		{ path: '/recipe/:id', component: RecipeShow },
		{ path: '/login', component: Login },
		{ path: '/', component: RecipeIndex },

	]
})

export default router
