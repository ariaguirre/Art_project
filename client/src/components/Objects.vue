<template>
  <div>
    <h1 class="h1">Artworks</h1>
    <div class="container">
      <div v-for="(artwork, index) in artworks" :key="index" class="artwork-item">
        <div class="artwork-info">
          <h2>{{ artwork.title }} - {{ artwork.artistDisplayName }}</h2>
          <img :src="artwork.primaryImage" alt="Artwork" class="artwork-image" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      artworks: []
    };
  },
  mounted() {
    this.fetchArtworks();
  },
  methods: {
    fetchArtworks() {
      axios.get('http://127.0.0.1:8000/objects')
        .then(response => {
          console.log(this.artworks);
          this.artworks = response.data;
        })
        .catch(error => {
          console.error('Error fetching artworks:', error);
        });
    }
  }
};
</script>


<style scoped src="./ObjectsStyles.css"></style>  