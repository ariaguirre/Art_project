<template>
  <div class="back">
    <div class="header">
        <h2>Departments</h2>
    </div>
    <div class="container">
      <button class="btn" @click="objects">European Paintings</button>
      <button class="btn" @click="asia">Asian Art</button>
      <button class="btn" @click="africa">Arts of Africa, Oceania, and the Americas</button>
      <button class="btn" @click="egypt">Egyptian Art</button>
      <button class="btn" @click="greek">Greek and Roman Art</button>
      <button class="btn" @click="islamic">Islamic Art</button>
    </div>
  </div>
</template>

<script>
export default {
    methods: {
      objects() {
        this.$router.push('/objects');
      },
      asia() {
        this.$router.push('/asia');
      },
      africa() {
        this.$router.push('/africa');
      }, 
      greek() {
        this.$router.push('/greek');
      }, 
      islamic() {
        this.$router.push('/islamic');
      },
      egypt() {
        this.$router.push('/egypt');
      }
    }
  };
</script>
<style scoped src="./Departments.css"></style>
