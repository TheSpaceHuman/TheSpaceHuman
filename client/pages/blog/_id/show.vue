<template>
  <el-main class="main">
    <div class="container" v-loading="$store.getters.getLoading">
      <section class="post-show">
        <div class="post-show__img">
          <img :src="post.image" :alt="post.title">
        </div>
        <div class="post-show__data">{{ post.updated_at }}</div>
        <h1 class="post-show__title"> {{ post.title }}</h1>
        <div class="post-show__body">{{ post.body }}</div>
        <div class="post-show__tags">Tags: #{{ post.tags }}</div>
      </section>
    </div>
  </el-main>
</template>

<script>
  export default {
    name: 'PostShow',
    middleware: 'auth',
    data() {
      return {
        post: ''
      }
    },
    methods: {
      async loadingPost() {
        try {
          this.$store.commit('setLoading', true)
          const res = await this.$axios({
            method: 'get',
            url: `post/${this.$route.params.id}/show`
          })
          this.post = res.data.data[0]
          this.$store.commit('setLoading', false)
        } catch (e) {
          console.log(e)
        }
      }
    },
    created() {
      this.loadingPost()
    }
  }
</script>

<style lang="scss">
.post-show {

  &__data {
    text-align: right;
    font-size: 14px;
    font-weight: 300;
    padding: 10px;
  }
  &__title {
    font-size: 22px;
    font-weight: 700;
  }
  &__body {
    text-align: justify;
    font-size: 17px;
    font-weight: 400;
    margin-bottom: 35px;
  }
  &__tags {
    font-size: 16px;
    font-weight: 300;
  }
  &__img {
    img {
      display: block;
      margin: 0 auto;
      height: 275px;
      object-fit: cover;
    }
  }
}
</style>