<template>
    <div>
      <div class="header">
        <h2>Art project title</h2>
      </div>
      <button class="btn" @click="goToObjects">Visit virtual museum</button>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      goToObjects() {
        this.$router.push('/objects');
      }
    }
  };
  </script>
    <style scoped src="./Home.css"></style>