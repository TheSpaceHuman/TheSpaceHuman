<template>
  <el-main class="main">
    <div class="container" v-loading="$store.getters.getLoading">
      <section class="post-edit">
        <h1>Измение поста {{ post.id }}</h1>
        <form @submit.prevent="updatePost">
          <div class="post-edit__form-group">
            <label for="title">Название</label>
            <el-input
              id="title"
              label="Название"
              v-model="post.title"></el-input>
          </div>
         <div class="post-edit__form-group">
           <label for="body">Контент</label>
           <el-input
             id="body"
             v-model="post.body"
             type="textarea"
             rows="10"></el-input>
         </div>
         <div class="post-edit__form-group">
           <label for="tags">Теги</label>
           <el-input
             id="tags"
             v-model="post.tags"></el-input>
         </div>
          <el-button type="warning" native-type="submit">Обновить</el-button>
        </form>
      </section>
    </div>
  </el-main>
</template>

<script>
  export default {
    name: 'PostEdit',
    middleware: 'auth',
    data() {
      return {
        post: ''
      }
    },
    methods: {
      async updatePost() {
        try {
          this.$store.commit('setLoading', true)
          const res = await this.$axios({
            method: 'put',
            url: `post/${this.$route.params.id}/update`,
            data: this.post
          })
          this.$message({
            showClose: true,
            message: res.data.message.body,
            type: res.data.message.type
          })
          this.$router.push({name: 'blog-id-show', params:{ id: this.post.id }})
        } catch (e) {
          console.log(e)
        }
      },
      async loadingPost() {
        try {
          this.$store.commit('setLoading', true)
          const res = await this.$axios({
            method: 'get',
            url: `post/${this.$route.params.id}/show`
          })
          console.log(res)
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
.post-edit {
  label {
    display: block;
    margin-bottom: 8px;
  }
  &__form-group {
    margin-bottom: 20px;
  }
}
</style>