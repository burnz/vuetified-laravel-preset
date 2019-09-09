import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import vuetify from '@/plugins/vuetify'

Vue.use(InertiaApp)

Vue.config.productionTip = false

const app = document.getElementById('app')

new Vue({
    vuetify,
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)
