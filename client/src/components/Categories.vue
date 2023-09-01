<template>
    <div class="back">
      <div class="header">
        <h2 class="h1">Artworks of the World</h2>
      </div>
      <div class="all-cont">
        <div class="cat-cont" data-category="European Art">
          <router-link to="/europe">
            <!-- <button>European Art</button> -->
            <img src="../img/img1.jpg"/>
          </router-link>
        </div>
        <div class="cat-cont" data-category="Asian Art">
            <router-link to="/asia">
            <!-- <button>Asian art</button> -->
            <img src="../img/asia.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont" data-category="Arts of Africa, Oceania, and the Americas">
            <router-link to="/africa">
            <!-- <button>Arts of Africa, Oceania, and the Americas</button> -->
            <img src="../img/africa.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont" data-category="Egyptian Art">
            <router-link to="/egypt">
            <!-- <button>Egyptian Art</button> -->
            <img src="../img/egypt.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont" data-category="Greek and Roman Art">
            <router-link to="/greek">
            <!-- <button>Greek and Roman Art</button> -->
            <img src="../img/greek.jpg"/>
            </router-link>
        </div>
        <div class="cat-cont" data-category="Islamic Art">
            <router-link to="/islamic">
            <!-- <button>Islamic Art</button> -->
            <img src="../img/islamic.jpg"/>
            </router-link>
        </div>
      </div>
  </div>
  </template>
    <style scoped src="./Home.css"></style>