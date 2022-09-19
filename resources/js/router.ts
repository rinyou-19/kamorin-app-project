import { createRouter, createWebHistory} from 'vue-router'
import login from './login.vue'
import menu from './menu.vue'
import purchase from './purchase.vue'
import inquiry from './inquiry.vue'
import analyse from './analyse.vue'
import contact from './contact.vue'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'login',
            components: {
                default: login,
            }
        },
        {
            path: '/menu',
            name: 'menu',
            components: {
                default: menu,
            }
        },
        {
            path: '/purchase',
            name: 'purchase',
            components: {
                default: menu,
                contents: purchase,
            }
        },
        {
            path: '/inquiry',
            name: 'inquiry',
            components: {
                default: menu,
                contents: inquiry,
            }
        },
        {
            path: '/analyse',
            name: 'analyse',
            components: {
                default: menu,
                contents: analyse,
            }
        },
        {
            path: '/contact',
            name: 'contact',
            components: {
                default: menu,
                contents: contact,
            }
        }
    ]
})