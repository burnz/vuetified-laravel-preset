import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import 'roboto-fontface/css/roboto/roboto-fontface.css'

//? https://vuetifyjs.com/en/framework/icons#using-custom-icons

import 'material-design-icons-iconfont/dist/material-design-icons.css'     //! iconfont: 'md'
//import '@mdi/font/css/materialdesignicons.css'                          //! iconfont: 'mdi'
//import '@fortawesome/fontawesome-free/css/all.css'                      //! iconfont: 'fa'
//import 'font-awesome/css/font-awesome.min.css'                          //! iconfont: 'fa4'

Vue.use(Vuetify.{
    icons: {
        iconfont: 'md'  //! 'md' || 'mdi' || 'fa' || 'fa4' || mdiSvg
        //! use mdiSvg if you dont need all the icons
        //! Manually add icons in your component for mdiSvg
        /** -----------------------------------/
        < template >
            <v-icon>{{ svgPath }}</v-icon>
        </template >
        
        <script>
        import {mdiAccount} from '@mdi/js'
            export default {
                        data: () => ({
                        svgPath: mdiAccount
                })
            }
        </script>
        ----------------------------------------*/
    },
    theme: {
        primary: '#BA9A5a',
        secondary: '#607D8B',
        accent: '#103050',
        error: '#800020',
        info: '#7fcac3',
        success: '#00695c',
        warning: '#f9a825'
    },
    options:{
        //? Enabling customProperties will also generate a css variable for each theme color
        //? which you can then use in your components' <style> blocks.
        /** -------------------------------------------
         <style scoped>
        .something {
            color: var(--v-primary-base)
            background-color: var(--v-accent-lighten2)
        }
        </style>
        ----------------------------------------------*/
        customProperties: true
    }
})



