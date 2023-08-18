<template>
  <div>
    <div class="header">
      <h2>Virtual Art Gallery</h2>
    </div>
    <button class="btn" @click="goToObjects">Visit virtual museum</button>
    <section class="carousel" aria-label="Gallery">
      <ol class="carousel__viewport">
  <li id="carousel__slide"
  tabindex="0"
  class="carousel__slide">
  <div class="carousel__snapper">
  <img src="../img/img2.jpg" alt="Image 2" />
  <img src="../img/img5.jpg" alt="Image 2" />
  <img src="../img/img6.jpg" alt="Image 2" />
  <img src="../img/img7.jpg" alt="Image 2" />
  <img src="../img/img4.jpg" alt="Image 2" />
  <img src="../img/img1.jpg" alt="Image 2" />
</div>
</li>
</ol>
</section>
</div>
</template>

<script>
export default {
  methods: {
    goToObjects() {
      this.$router.push('/objects');
    }
  }
};
</script>
  <style scoped src="./Home.css"></style>