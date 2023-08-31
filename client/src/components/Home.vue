<template>
  <div class="back">
    <div class="header">
      <h2>Virtual Art Gallery</h2>
    </div>
    <button class="btn" @click="categories">Visit virtual museum</button>
    <!-- <section class="carousel" aria-label="Gallery"> -->
      <ol class="carousel__viewport">
  <li id="carousel__slide"
  tabindex="0"
  class="carousel__slide">
  <div class="carousel__snapper">
  <img src="../img/img2.jpg"/>
  <img src="../img/img5.jpg"/>
  <img src="../img/img6.jpg"/>
  <img src="../img/img7.jpg"/>
  <img src="../img/img4.jpg"/>
  <img src="../img/img1.jpg"/>
  <img src="../img/img2.jpg"/>
  <img src="../img/img5.jpg"/>
  <img src="../img/img6.jpg"/>
  <img src="../img/img7.jpg"/>
  <img src="../img/img4.jpg"/>
  <img src="../img/img1.jpg"/>
  <img src="../img/img2.jpg"/>
  <img src="../img/img5.jpg"/>
  <img src="../img/img6.jpg"/>
  <img src="../img/img7.jpg"/>
  <img src="../img/img4.jpg"/>
  <img src="../img/img1.jpg"/>
  <img src="../img/img2.jpg"/>
  <img src="../img/img5.jpg"/>
  <img src="../img/img6.jpg"/>
  <img src="../img/img7.jpg"/>
  <img src="../img/img4.jpg"/>
  <img src="../img/img1.jpg"/>
</div>
</li>
</ol>
<!-- </section> -->
</div>
</template>

<script>
export default {
  methods: {
      categories() {
        this.$router.push('/categories');
      }
  }
};
</script>
  <style scoped src="./Home.css"></style>