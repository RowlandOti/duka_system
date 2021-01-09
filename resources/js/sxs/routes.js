/*=========================================================================================
  File Name: routes.js
  Description: Routes for vue-routes. Lazy loading is enabled.
  Object Strucutre:
                    path => routes path
                    name => routes name
                    component(lazy loading) => component to load
                    meta : {
                      rule => which user can have access (ACL)
                      breadcrumb => Add breadcrumb to specific page
                      pageTitle => Display title besides breadcrumb
                    }
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import VueRouter from 'vue-router'
import FullPage from "./layouts/FullPage";
import Login from "./components/pages/auth/login/Login";
import Register from "./components/pages/auth/register/Register";
import ForgotPassword from "./components/pages/auth/ForgotPassword";
import ResetPassword from "./components/pages/auth/ResetPassword";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior() {
        return {x: 0, y: 0}
    },
    routes: [

        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: '',
            component: FullPage,
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '/pages/login',
                    name: 'page-login',
                    component: Login,
/*                    meta: {
                        rule: 'editor'
                    }*/
                },
                {
                    path: '/pages/register',
                    name: 'page-register',
                    component: Register,
                    /*meta: {
                        rule: 'editor'
                    }*/
                },
                {
                    path: '/pages/forgot-password',
                    name: 'page-forgot-password',
                    component: () => ForgotPassword,
/*                    meta: {
                        rule: 'editor'
                    }*/
                },
                {
                    path: '/pages/reset-password',
                    name: 'page-reset-password',
                    component: () => ResetPassword,
/*                    meta: {
                        rule: 'editor'
                    }*/
                },
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/pages/error-404'
        }
    ],
})

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = "none";
    }
})

router.beforeEach((to, from, next) => {
    next()
});

export default router
