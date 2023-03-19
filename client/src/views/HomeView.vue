<script>
import FruiteCard from '../components/FruitCard.vue'
import Api from '../Api';

export default {
  components: { FruiteCard },
  data() {
    const fruits = [];
    const list = {};
    const pages = 1;
    const page = 1;
    const query = {name: null, family: null};

    return { fruits, list, pages, page, query }
  },
  watch: {
    page: {
      handler: function (val, oldVal) {
        this.getList({...this.query, page: this.page});
      }
    },
    query: {
      handler: function (val, oldVal) {
        this.getList(this.query);
      },
      deep: true
    },
  },
  mounted(){
    this.getList();
    this.getFilter();
  },
  methods: {
    getList(query){
      Api.get('fruits', query)
        .then(data => {
          this.fruits = data.items
          this.pages = data.pages
        })
        .catch(error => alert('error'));
    },
    getFilter() {
      Api.get('fruits/name')
        .then(data => this.list.names = data.items)
        .catch(error => alert('error'));
      Api.get('fruits/family')
      .then(data => this.list.families = data.items)
      .catch(error => alert('error'));
    }
  }
}
</script>

<template>
  <v-row>
    <v-col
      cols="12"
      md="3"
    >
      <v-select
        v-model="query.name"
        clearable
        label="Select Name"
        :items="list.names"
        variant="underlined"
      />
    </v-col>
    <v-col
      cols="12"
      md="3"
    >
      <v-select
        v-model="query.family"
        clearable
        label="Select Family"
        :items="list.families"
        variant="underlined"
      />
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
  <v-pagination
    v-model="page"
    :length="pages"
    rounded="circle"
  />
</template>
