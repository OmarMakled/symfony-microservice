import { createApp } from 'vue'
import { createStore } from 'vuex'
import App from './App.vue'
import router from './router'

// Vuetify
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
const vuetify = createVuetify({
  components,
  directives
})
// Create a new store instance.
const store = createStore({
  state () {
    return {
      favorites: []
    }
  },
  mutations: {
    add (state, item) {
      state.favorites.push(item)
    },
    remove (state, item) {
      state.favorites = state.favorites.filter((obj) => obj.id !== item.id)
    }
  },
  getters: {
    isFavorite: (state) => (item) => {
      return state.favorites.find(e => e.id === item.id)
    },
    isFull: (state) => {
      return state.favorites.length === 10
    },
    total: (state) => {
      return state.favorites.length
    }
  }
})

const app = createApp(App)

app.use(router)
app.use(vuetify)
app.use(store)

app.mount('#app')
