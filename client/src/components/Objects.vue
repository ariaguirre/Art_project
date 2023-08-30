<template>
  <div class="back">
    <div class="header">
  <div class="header-left">
    <button class="menu-button" @click="showMenu = !showMenu"></button>
  </div>
  <div class="header-center">
    <h1 class="h1">European Artworks</h1>
  </div>
</div>
    <br/>
    <!-- <button class="dept" @click="toDepartments">Art departments</button> -->

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
    <div class="popup-overlay" v-if="showPopup">
      <div class="popup-content">
        <button class="close" @click="closePopup">X</button>
        <h1>Artwork detail</h1>
        <div class="popup-info">
          <h3>About the artist {{ selectedArtwork.artistDisplayName }}: </h3>
          <p>{{ selectedArtwork.artistDisplayBio }}.</p>
          <h3>About the Artwork "{{ selectedArtwork.title }}.":</h3>
          <label>Dimesions: {{ selectedArtwork.dimensions }}.</label>
          <br/>
          <label>Created between: {{ selectedArtwork.objectBeginDate }} - {{ selectedArtwork.objectEndDate }}.</label>
          <br/>
          <label>Department: {{ selectedArtwork.department }}.</label>
          <br/>
          <p>Click <a :href="selectedArtwork.artistWikidata_URL" target="_blank">here</a> to know more about {{ selectedArtwork.artistDisplayName }} and <a :href="selectedArtwork.objectURL" target="_blank">here</a> to know more about "{{ selectedArtwork.title }}".
          </p>
        </div>
        <img :src="selectedArtwork.primaryImage" alt="Artwork" class="artwork-image" />
      </div>
    </div>
    <router-link class="btn" to="/artworks">← Return</router-link>
      <h3 class="loading" v-if="isLoading">Loading...</h3>
      <div class="container">
        <div v-for="(artwork, index) in displayedArtworks" :key="index" class="artwork-item">
        <div class="artwork-info" @click="openPopup(artwork)">
          <h2>{{ artwork.title }}</h2>
          <h3>{{ artwork.artistDisplayName }}</h3>
          <img :src="artwork.primaryImage" alt="Artwork" class="artwork-image" />
        </div>
      </div>
      </div>
    <div class="pagination">
        <button style="border-radius: 20%; width:auto;" @click="previousPage" :disabled="currentPage === 1">Previous</button>
        <span class="btn" v-for="pageNumber in totalPages" :key="pageNumber">
          <button @click="gotoPage(pageNumber)" :class="{ active: pageNumber === currentPage }">{{ pageNumber }}</button>
        </span>
        <button  style="border-radius: 20%; width:auto;" @click="nextPage" :disabled="currentPage === totalPages">Next</button>
      </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isLoading: true,
      artworks: [],
      itemsPerPage: 20,
      currentPage: 1,
      showMenu: false,
      limit: 200,
      selectedArtwork: null,
      showPopup: false,
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
        const response = await axios.get('http://127.0.0.1:8000/all')
        this.artworks = response.data.slice(0, this.limit);
        console.log('this.artworks', this.artworks)
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
  }
};
</script>


<style scoped src="./Objects.css"></style>  