<template>
  <div>
    <h1>Artwork Detail</h1>
    <div>
      <h2>{{ artwork.title }} - {{ artwork.artistDisplayName }}</h2>
      <img :src="artwork.primaryImage" alt="Artwork" />
    </div>
    <router-link to="/objects">Volver a la lista</router-link>
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
        })
        .catch(error => {
          console.log('Error fetching artwork:', error);
        });
    }
  }
};
</script>

<style scoped src="./Detail.css"></style>
