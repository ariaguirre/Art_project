<template>
  <div>
    <div class="header">
      <h1>European Artworks</h1>
    </div>
    <br/>
    <br/>
    <router-link class="btn" to="/objects">Return</router-link>
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
      artwork: {}
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
