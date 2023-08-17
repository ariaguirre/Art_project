<template>
  <div>
    <div class="header">
      <h1 class="h1">European Artworks</h1>
    </div>
    <br/>
    <div class="container">
      <div v-for="(artwork, index) in displayedArtworks" :key="index" class="artwork-item">
      <router-link :to="'/detail/' + artwork.objectId">
        <div class="artwork-info">
          <h2>{{ artwork.title }}</h2>
          <h3>{{ artwork.artistDisplayName }}</h3>
          <img :src="artwork.primaryImage" alt="Artwork" class="artwork-image" />
        </div>
      </router-link>
    </div>
    </div>
    <div class="pagination">
      <button @click="previousPage" :disabled="currentPage === 1">Previous</button>
      <span class="btn" v-for="pageNumber in totalPages" :key="pageNumber">
        <button @click="gotoPage(pageNumber)" :class="{ active: pageNumber === currentPage }">{{ pageNumber }}</button>
      </span>
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
          this.artworks = response.data.map(artwork => ({
        ...artwork,
        objectId: artwork.objectId // Asegúrate de que el nombre del campo sea correcto
      }));
      console.log(this.artworks)
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
    },
    gotoPage(pageNumber) {
      this.currentPage = pageNumber;
    }
  }
};
</script>


<style scoped src="./Objects.css"></style>  