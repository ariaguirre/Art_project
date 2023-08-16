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
    <div class="pagination">
      <button @click="previousPage" :disabled="currentPage === 1">Previous</button>
      <span>{{ currentPage }} / {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      artworks: [],
      itemsPerPage: 10,
      currentPage: 1
    };
  },
  computed: {
    displayedArtworks() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.artworks.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.artworks.length / this.itemsPerPage);
    }
  },
  mounted() {
    this.fetchArtworks();
  },
  methods: {
    fetchArtworks() {
      axios.get('http://127.0.0.1:8000/objects')
        .then(response => {
          this.artworks = response.data;
        })
        .catch(error => {
          console.error('Error fetching artworks:', error);
        });
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    }
  }
};
</script>


<style scoped src="./ObjectsStyles.css"></style>  