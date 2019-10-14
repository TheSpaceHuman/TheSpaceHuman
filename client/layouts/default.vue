<template>
  <el-container class="app-wrapper">
    <el-header class="header">
      <main-menu />
    </el-header>
    <nuxt/>
    <el-footer class="footer">
      <blockquote class="footer__authors">
        <a href="https://github.com/TheSpaceHuman" target="_blank">TheSpaceHuman</a>
      </blockquote>
    </el-footer>
  </el-container>
</template>

<script>
  import MainMenu from '../components/MainMenu'
  export default {
    components: {
      MainMenu
    },
    data() {
      return {
        kek: ''
      }
    },
    watch: {
      $route() {
        this.$store.commit('setLoading', true)
      }
    }
  }
</script>
<style lang="scss">
  @import "../assets/scss/app";
</style>
