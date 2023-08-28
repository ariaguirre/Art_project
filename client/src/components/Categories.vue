<template>
    <div class="back">
      <div class="header">
        <h2 class="h1">Artworks of the World</h2>
      </div>
      <div class="all-cont">
        <div class="cat-cont">
            <router-link to="/europe">
            <h3>European Art</h3>
            <img src="../img/img1.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont">
            <router-link to="/asia">
            <h3>Asian art</h3>
            <img src="../img/img1.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont">
            <router-link to="/africa">
            <h3>Arts of Africa, Oceania, and the Americas</h3>
            <img src="../img/img1.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont">
            <router-link to="/egypt">
            <h3>Egyptian Art</h3>
            <img src="../img/img1.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont">
            <router-link to="/greek">
            <h3>Greek and Roman Art</h3>
            <img src="../img/img1.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont">
            <router-link to="/islamic">
            <h3>Islamic Art</h3>
            <img src="../img/img1.jpg"/>
            </router-link>
        </div>
      </div>
  </div>
  </template>
  
  <script>
  export default {
    methods: {
        artworks() {
          this.$router.push('/artworks');
        }
    }
  };
  </script>
    <style scoped src="./Home.css"></style>