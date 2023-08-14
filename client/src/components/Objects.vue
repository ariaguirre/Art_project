<template>
  <div>
    <h2>Objects List</h2>
    <ul>
      <li v-for="object in objects" :key="object.objectID">
        {{ object.title }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      objects: [],
      currentPage: 1,
      totalPages: 1,
    };
  },
  mounted() {
    this.fetchObjects(this.currentPage);
  },
  methods: {
    fetchObjects(page) {
      axios.get(`http://localhost:8000/objects?page=${page}&per_page=10`)
    .then(response => {
        this.objects = response.data.data;
        this.currentPage = response.data.current_page;
        this.totalPages = response.data.last_page;
    })
    .catch(error => {
        console.error(error);
    });
    },
    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.fetchObjects(page);
      }
    },
  },
};
</script>
