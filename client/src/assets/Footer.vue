<template>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="logo">
            <img src="ruta-del-logo.png" alt="Logo">
          </div>
          <div class="copyright">
            © 2023 Tu Empresa. Todos los derechos reservados.
          </div>
        </div>
        <div class="col-md-6">
          <div class="social-icons">
            <a href="https://github.com/tu-usuario" target="_blank">
              <i class="fab fa-github"></i>
            </a>
            <a href="https://www.linkedin.com/in/tu-usuario" target="_blank">
              <i class="fab fa-linkedin"></i>
            </a>
            <a href="mailto:correo@ejemplo.com">
              <i class="fas fa-envelope"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style scoped>
.footer {
  background-color: #f8f9fa;
  padding: 20px 0;
}

.logo img {
  max-width: 100px;
  height: auto;
}

.social-icons {
  font-size: 24px;
}

.social-icons a {
  color: #333;
  margin-right: 15px;
}

.social-icons a:hover {
  color: #007bff;
}
</style>
