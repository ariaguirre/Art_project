<template>
  <div class="back">
    <div class="header">
  <div class="header-left">
    <button class="menu-button" @click="showMenu = !showMenu"></button>
  </div>
  <div class="header-center">
    <h1 class="h1">Artworks</h1>
  </div>
</div>
      <br/>
      <div :class="{ 'popup': true, 'popup-active': showMenu }">
      <button class="close" @click="showMenu = !showMenu">X</button>
      <p>Art categories</p>
        <ul class="menu-list">
        <li><router-link to="/europe">European Art</router-link></li>
        <li><router-link to="/asia">Asian Art</router-link></li>
        <li><router-link to="/africa">Arts of Africa, Oceania, and the Americas</router-link></li>
        <li><router-link to="/egypt">Egyptian Art</router-link></li>
        <li><router-link to="/greek">Greek and Roman Art</router-link></li>
        <li><router-link to="/islamic">Islamic Art</router-link></li>
      </ul>
    </div>
    <router-link class="btn" to="/artworks">← Return</router-link>
    <div class="container">
      <h2>{{ artwork.title }} - {{ artwork.artistDisplayName }}</h2>
      <br/>
      <div class="about">
        <h3>About the artist {{ artwork.artistDisplayName }}: </h3>
        <p>{{ artwork.artistDisplayBio }}</p>
        <h3>About the artwork "{{ artwork.title }}":</h3>
        <label>Dimesions: {{ artwork.dimensions }}</label>
        <label>Created between: {{ artwork.objectBeginDate }} - {{ artwork.objectEndDate }}</label>
        <label>Department: {{ artwork.department }}</label>

        <p>Click <a :href="artwork.artistWikidata_URL" target="_blank">here</a> to know more about {{ artwork.artistDisplayName }} and <a :href="artwork.objectURL" target="_blank">here</a> to know more about "{{ artwork.title }}"
    </p>
      </div>
      
    </div>
      <img :src="artwork.primaryImage" alt="Artwork" />
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      artwork: {},
      showMenu: false
    };
  },
  created() {
    const objectId = this.$route.params.objectId;
    this.fetchArtworkDetail(objectId);
  },
  methods: {
    fetchArtworkDetail(objectId) {
      axios.get(`http://127.0.0.1:8000/objects/${objectId}`)
        .then(response => {
          this.artwork = response.data;
          console.log(this.artwork)
        })
        .catch(error => {
          console.log('Error fetching artwork:', error);
        });
    }
  }
};
</script>

<style scoped src="./Detail.css"></style>
