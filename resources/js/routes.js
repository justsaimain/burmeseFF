export const routes = [
    {
		path: '/',
        component: () => import('./components/AppComponent.vue')
    },
	{
		path: '/home',
        component: () => import('./components/AppComponent.vue')
    },
    {
		path:'/login',
        component: () => import('./components/LoginComponent.vue')
    },
	{
		path:'/register',
        component: () => import('./components/RegisterComponent.vue')
    },
    {
		path:'/profile',
        component: () => import('./pages/ProfilePage.vue')
    },
];
