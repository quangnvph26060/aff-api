import { createStore } from 'vuex'
import auth from './auth.js'
const store = createStore({
    plugins:[
    ],
    modules:{
        auth : auth,
    }
})

export default store