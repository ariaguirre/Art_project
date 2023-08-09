<template>
  <div>
    <h2>Departments List</h2>
    <ul>
      <li v-for="department in departments" :key="department.departmentId">
        {{ department.displayName }}
      </li>
    </ul>
    
    <!-- <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Previous</button> -->
    <!-- <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">Next</button> -->
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      departments: [],
      currentPage: 1,
      totalPages: 1,
    };
  },
  mounted() {
    this.fetchDepartments(this.currentPage);
  },
  methods: {
    fetchDepartments(page) {
      axios.get(`http://localhost:8000/departments?page=${page}&per_page=10`)
        .then(response => {
          console.log('response.data', response.data.data)
          this.departments = response.data.data;
          console.log('this.departments', this.departments)
          this.currentPage = response.data.current_page;
          this.totalPages = response.data.last_page;
        })
        .catch(error => {
          console.error(error);
        });
    },
    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.fetchDepartments(page);
      }
    },
  },
};
</script>
