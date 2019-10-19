<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Blog</h1>
      <section class="blog">
        <el-row type="flex" class="blog__row" v-loading="$store.getters.getLoading">
          <el-col
            :sm="24"
            :md="12"
            :lg="8"
            v-for="(post,i) in $store.getters.getPosts"
            class="blog__col"
          >
            <el-card class="blog__card">
              <div class="blog__card__img">
                <img :src="post.image" :alt="post.title">
              </div>
              <div class="blog__card__date">{{ post.updated_at }}</div>
              <h4 class="blog__card__title">{{ post.title }}</h4>
              <p class="blog__card__subtitle">{{ post.body | truncate(110) }}</p>
              <div class="blog__card__tags">{{ post.tags }}</div>
              <div class="blog__card__actions">
                <el-button type="primary">Подробно</el-button>
              </div>
            </el-card>
          </el-col>
        </el-row>
        <el-row>
          <el-col
            :sm="24"
            :md="24"
            :lg="24"
          >
            <ThePagination></ThePagination>
          </el-col>
        </el-row>
      </section>
    </div>
  </el-main>
</template>


<script>
  import ThePagination from '@/components/Blog/ThePagination.vue'
  export default {
    name: 'Blog',
    middleware: 'auth',
    components: {
      ThePagination
    },
    data() {
      return {
      }
    },
    created() {
      this.$store.dispatch('loadingPosts');
    }
  }
</script>

<style lang="scss">
.blog {

  &__row {
    flex-wrap: wrap;
  }
  &__col {
    padding: 10px;
  }

  &__card {

    &__date {
      font-size: 15px;
      font-weight: 300;
      text-align: right;
      padding: 20px 0;
    }
    &__title {
      font-size: 20px;
    }
    &__subtitle {
      font-weight: 300;
    }
    &__tags {
      padding: 20px 0;
      font-weight: 400;
      font-size: 17px;
      text-align: right;
    }
    &__img {

      img {
        width: 100%;
        max-height: 300px;
        display: block;
        object-fit: cover;
      }
    }
  }
}
</style>
