<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: {
    isFavorite() {
      return this.$store.getters.isFavorite(this.item);
    },
    isFull() {
      return this.$store.getters.isFull;
    }
  },
  methods: {
    add(){
      if (this.isFull) {
        return;
      }
      this.$store.commit('add', this.item)
    },
    remove(){
      this.$store.commit('remove', this.item)
    },
    toggle(){
     this.isFavorite ? this.remove() : this.add();
    }
  }
}
</script>
<template>
  <v-card class="fill-height">
    <template #title>
      {{ item.name }} 

      <v-btn
        size="small"
        variant="text"
        :icon="isFavorite ? 'mdi-heart' : 'mdi-heart-outline'"
        color="deep-purple darken-1"
        @click="toggle()"
      />
    </template>

    <template #subtitle>
      {{ item.family }} . {{ item.order }} . {{ item.genus }}
    </template>
    <v-card-text>
      <v-chip
        v-for="(i, e) of item.nutritions"
        :key="e"
        class="ma-1"
        variant="plain"
      >
        {{ e }} 
        <v-badge
          color="deep-purple-lighten-4"
          :content="i"
          inline
        />
      </v-chip>
    </v-card-text>
  </v-card>
</template>