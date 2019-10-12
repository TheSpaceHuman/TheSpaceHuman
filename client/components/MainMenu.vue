<template>
  <div class="header__main-menu">
    <el-menu :default-active="activeIndex" class="header__main-menu__list" mode="horizontal" @select="handleSelect" :router="false">
      <el-menu-item class="header__logo">
       <nuxt-link to="/">TheSpaceHuman</nuxt-link>
      </el-menu-item>
      <nuxt-link
        :to="item.link"
        tag="el-menu-item"
        v-for="(item, i) in menuItems"
        :key="i">
        {{ item.title }}
      </nuxt-link>

      <el-menu-item class="header__login" v-if="!$auth.loggedIn">
        <nuxt-link
          :to="{name: 'auth-login'}"
          tag="el-menu-item">
          Login
        </nuxt-link>
      </el-menu-item>
      <el-menu-item class="header__profile" v-if="$auth.loggedIn">
        <TheProfile></TheProfile>
      </el-menu-item>
    </el-menu>
  </div>
</template>

<script>
import TheProfile from './TheProfile'
export default {
  name: 'MainMenu',
  components: {
    TheProfile
  },
  data() {
    return {
      activeIndex: "0",
      menuItems: [
        {title:'Dashboard', link: {name: 'index'},exact: true},
        {title:'Passwords', link: {name: 'passwords'},exact: false},
        {title:'Blog', link: {name: 'blog'},exact: false},
        {title:'TodoList', link: {name: 'todo-list'},exact: false},
      ]
    }
  },
  methods: {
    handleSelect(key, keyPath) {
      // console.log(key, keyPath);
      // console.log(this.$route)
    }
  },
  watch:{
    $route() {
      // console.log()
    }
  }
}
</script>

<style lang="scss">
  .el-menu-item.nuxt-link-exact-active {
    border-bottom: 2px solid #409eff!important;
    color: #303133!important;
  }
</style>