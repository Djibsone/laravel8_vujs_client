import { createRouter, createWebHistory } from "vue-router";

import CustomerIndex from '../components/CustomerIndex';
import CustomerCreate from '../components/CustomerCreate';

const routes = [
    {
        path: '/dashboard',
        name: 'customers.index',
        component: CustomerIndex
    },
    {
        path: '/customers/create',
        name: 'customers.create',
        component: CustomerCreate
    }
];


export default createRouter({
    history: createWebHistory(),
    routes
});