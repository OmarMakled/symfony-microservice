<script>
import {  RouterView } from 'vue-router'

export default {
  computed: {
    total() {
      return this.$store.getters.total;
    },
    isFull() {
      return this.$store.getters.isFull;
    }
  },
}
</script>
<template>
  <v-app id="app">
    <v-app-bar
      class="px-3"
      color="white"
      flat
      density="compact"
    >
      <v-spacer />
    
      <v-btn
        class="mx-4 white--text"
        x-large
        rounded
        color="deep-purple darken-1"
        to="/"
      >
        Home
      </v-btn>
      <v-btn
        class="mx-4 white--text"
        x-large
        rounded
        color="deep-purple darken-1"
        to="/favorite"
      >
        <v-badge :content="total">
          <v-icon
            icon="mdi-heart"
            size="x-large"
          />
        </v-badge>
      </v-btn>
      <v-spacer />
    </v-app-bar>

    <v-main class="bg-grey-lighten-3">
      <v-container>
        <v-alert
          v-if="isFull"
          type="info"
          density="compact"
          text="The favorites list is full"
          class="mb-5"
        />
        <RouterView />
      </v-container>
    </v-main>
  </v-app>
</template>