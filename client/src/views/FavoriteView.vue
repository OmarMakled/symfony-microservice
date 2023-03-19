<script>
import FruiteCard from '../components/FruitCard.vue'

export default {
  components: { FruiteCard },
  computed: {
    fruits () {
      return this.$store.state.favorites
    },
    nutritions() {
      const nutritions = {};
      for(const item of this.fruits) {
          for (const [key, value] of Object.entries(item.nutritions)) {
              if (!Object.hasOwn(nutritions, key)){
                  nutritions[key] = 0;
              }

              nutritions[key] = nutritions[key] + value
          }
      }

      return nutritions;
    }
  }
}
</script>

<template>
  <v-row>
    <v-col>
      <v-chip
        v-for="(val, title, index) of nutritions"
        :key="index"
        class="ma-1"
        variant="text"
      >
        {{ title }}
        <v-badge
          color="deep-purple-lighten-4"
          inline
          :content="val.toFixed(2)"
        />
      </v-chip>
    </v-col>
  </v-row>
  <v-row>
    <v-col
      v-for="(item, index) in fruits"
      :key="index"
      cols="12"
      md="3"
    >
      <FruiteCard
        :key="index"
        :item="item"
      />
    </v-col>
  </v-row>
</template>
