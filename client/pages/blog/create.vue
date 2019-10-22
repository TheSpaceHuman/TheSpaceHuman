<template>
  <el-main class="main">
    <div class="container">
      <section class="post-create">
        <h1>Создание нового поста</h1>
        <form @submit.prevent="createPost">
          <div class="post-create__form-group">
            <label for="title">Название</label>
            <el-input
              id="title"
              label="Название"
              v-model="post.title"
              @blur="$v.post.title.$touch()"
              :class="{
                  'is-invalid': $v.post.title.$invalid && $v.post.title.$dirty,
                  'is-valid': !$v.post.title.$invalid && $v.post.title.$dirty
                  }"
            ></el-input>
            <div class="invalid-feedback" v-if="!$v.post.title.required && $v.post.title.$dirty">Поле обязательное</div>
            <div class="invalid-feedback" v-if="!$v.post.title.maxLength && $v.post.title.$dirty">Слишком много символов, максимум: {{ $v.post.title.$params.maxLength.max }} символов</div>
          </div>
         <div class="post-create__form-group">
           <label for="body">Контент</label>
           <el-input
             id="body"
             v-model="post.body"
             type="textarea"
             rows="10"
             @blur="$v.post.body.$touch()"
             :class="{
                  'is-invalid': $v.post.body.$invalid && $v.post.body.$dirty,
                  'is-valid': !$v.post.body.$invalid && $v.post.body.$dirty
                  }"
           ></el-input>
           <div class="invalid-feedback" v-if="!$v.post.body.required && $v.post.body.$dirty">Поле обязательное</div>
         </div>
         <div class="post-create__form-group">
           <label for="tags">Теги</label>
           <el-input
             id="tags"
             v-model="post.tags"
             @blur="$v.post.tags.$touch()"
             :class="{
                  'is-invalid': $v.post.tags.$invalid && $v.post.tags.$dirty,
                  'is-valid': !$v.post.tags.$invalid && $v.post.tags.$dirty
                  }"
           ></el-input>
           <div class="invalid-feedback" v-if="!$v.post.tags.required && $v.post.tags.$dirty">Поле обязательное</div>
           <div class="invalid-feedback" v-if="!$v.post.tags.maxLength && $v.post.tags.$dirty">Слишком много символов, максимум: {{ $v.post.title.$params.maxLength.max }} символов</div>
         </div>
          <el-button type="primary" native-type="submit" :disabled="$v.$error">Создать</el-button>
        </form>
      </section>
    </div>
  </el-main>
</template>

<script>
  import { required, maxLength } from 'vuelidate/lib/validators'
  export default {
    name: 'PostCreate',
    middleware: 'auth',
    data() {
      return {
        post: {
          title: '',
          body: '',
          tags: '',
        }
      }
    },
    validations: {
      post: {
        title: {
          required,
          maxLength: maxLength(255)
        },
        body: {
          required
        },
        tags: {
          required,
          maxLength: maxLength(255)
        }
      }
    },
    methods: {
      async createPost() {
        try {
          this.$store.commit('setLoading', true)
          const res = await this.$axios({
            method: 'post',
            url: `post/store`,
            data: this.post
          })
          this.$message({
            showClose: true,
            message: res.data.message.body,
            type: res.data.message.type
          })
          this.$router.push({name: 'blog'})
        } catch (e) {
          console.log(e)
        }
      }
    }
  }
</script>

<style lang="scss">
.post-create {
  label {
    display: block;
    margin-bottom: 8px;
  }
  &__form-group {
    margin-bottom: 20px;
  }
}
</style>