<template>
  <div class="back">
    <div class="header">
  <div class="header-left">
    <button class="menu-button" @click="showMenu = !showMenu"></button>
  </div>
  <div class="header-center">
    <h1 class="h1">Greek and Roman Art</h1>
  </div>
</div>
<div class="search-bar">
      <input
        type="text"
        v-model="searchTerm"
        placeholder="Search Title or Artist"
      />
      <button @click="search">🔍︎</button>
    </div>
    <div class="return">
      <router-link  to="/categories" v-if="display">← Return</router-link>
    </div>
      <br/>
      <div :class="{ 'popup': true, 'popup-active': showMenu }">
      <button class="close" @click="showMenu = !showMenu">X</button>
      <p>Art categories</p>
        <ul class="menu-list">
        <li><router-link to="/categories">Home</router-link></li>
        <li><router-link to="/europe">European Art</router-link></li>
        <li><router-link to="/asia">Asian Art</router-link></li>
        <li><router-link to="/africa">Arts of Africa, Oceania, and the Americas</router-link></li>
        <li><router-link to="/egypt">Egyptian Art</router-link></li>
        <li><router-link to="/greek">Greek and Roman Art</router-link></li>
        <li><router-link to="/islamic">Islamic Art</router-link></li>
      </ul>
    </div>
    <div v-if="searchResults.length > 0" class="result-container">
      <div v-for="(artwork, index) in searchResults" :key="index" class="artwork-item">
        <div class="artwork-info" @click="openPopup(artwork)">
          <h2>{{ artwork.title }}</h2>
          <h3>{{ artwork.artistDisplayName || 'Unknown' }}</h3>
          <img :src="artwork.primaryImage" alt="Artwork" class="artwork-image" />
        </div>
      </div>
    </div>
    <div class="noResults" v-if="noResults == 1">
          <p>No results found.</p>
        </div>
    <div class="popup-overlay" v-if="showPopup">
      <div class="popup-content">
        <button class="close" @click="closePopup">X</button>
        <h1>Artwork detail</h1>
        <div class="popup-info">
          <h3>{{ selectedArtwork.artistDisplayName || 'Unknown artist' }}</h3>
          <p>{{ selectedArtwork.artistDisplayBio || 'Bio not available' }}.</p>
          <h3>About the Artwork "{{ selectedArtwork.title }}.":</h3>
          <label>Dimesions: {{ selectedArtwork.dimensions }}.</label>
          <br/>
          <label>Created between: {{ selectedArtwork.objectBeginDate }} - {{ selectedArtwork.objectEndDate }}.</label>
          <br/>
          <label>Department: {{ selectedArtwork.department }}.</label>
          <br/>
          <p>Click <a :href="selectedArtwork.objectURL" target="_blank">here</a> to know more about "{{ selectedArtwork.title }}".
          </p>
        </div>
        <img :src="selectedArtwork.primaryImage" alt="Artwork" class="artwork-image" />
      </div>
    </div>
      <h3 class="loading" v-if="isLoading">Loading...</h3>
      <div class="container" v-if="display">
        <div v-for="(artwork, index) in displayedArtworks" :key="index" class="artwork-item">
        <div class="artwork-info" @click="openPopup(artwork)">
          <h2>{{ artwork.title }}</h2>
          <h3>{{ artwork.artistDisplayName || 'Unknown'}}</h3>
          <img :src="artwork.primaryImage" alt="Artwork" class="artwork-image" />
        </div>
      </div>
      </div>
      <div class="pagination" v-if="display">
        <button style="border-radius: 50%; padding: 5px 10px; width:auto; font-weight: 900;" @click="previousPage" :disabled="currentPage === 1">←</button>
        <span class="btn" v-for="pageNumber in totalPages" :key="pageNumber">
          <button @click="gotoPage(pageNumber)" :class="{ active: pageNumber === currentPage }">{{ pageNumber }}</button>
        </span>
        <button  style="border-radius: 50%; padding: 5px 10px; width:auto; background-color: transparent;" @click="nextPage" :disabled="currentPage === totalPages">→</button>
      </div>
      <Footer/>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import Footer from './Footer.vue';

  
  export default {
    components:{
    Footer,
  },
    data() {
      return {
        isLoading: true,
        artworks: [],
        itemsPerPage: 10,
        currentPage: 1,
        showMenu: false,
        selectedArtwork: null,
        showPopup: false,
        searchResults: [], 
        display: true,
        noResults: 0
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
      async fetchArtworks() {
        try{
        const response = await axios.get('http://127.0.0.1:8000/all-g');
        this.artworks = response.data.slice(0, 100);
        this.isLoading = false;
        }catch(error){
          console.error('Error fetching artworks:', error);
        };
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
      },
      openPopup(artwork) {
      this.selectedArtwork = artwork;
      this.showPopup = true;
    },

    closePopup() {
      this.selectedArtwork = null;
      this.showPopup = false;
    },
    async search() {
    this.isLoading = true;
    this.display = false;
    try {
      const response = await axios.get(`http://127.0.0.1:8000/search-g?term=${this.searchTerm}`);
      this.searchResults = response.data;
      if (this.searchResults.length <= 0) this.noResults = 1;
      if (this.searchResults.length > 0) this.noResults = 0;
    } catch (error) {
      console.error('Error al realizar la búsqueda:', error);
      this.searchResults = [];
    } finally {
      this.isLoading = false; 
    }
  },
    }
  };
  </script>
  
  
  <style scoped src="./Objects.css"></style>  