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
            <nav class="paginate">
              <el-pagination
                background
                layout="prev, pager, next"
                @current-change="changePage"
                :current-page="$store.getters.getPagination.meta.current_page"
                :page-size="$store.getters.getPagination.meta.per_page"
                :total="$store.getters.getPagination.meta.total">
              </el-pagination>
            </nav>

          </el-col>
        </el-row>
      </section>
    </div>
  </el-main>
</template>


<script>
  export default {
    name: 'Blog',
    middleware: 'auth',
    data() {
      return {
      }
    },
    methods: {
      changePage: (page) => {
        this.$store.dispatch('loadingPosts', {
          method: 'get',
          url: 'post',
          params: {
            page: page
          }
        });
        console.log('page: ', page)
      },
    },
    created() {
      this.$store.dispatch('loadingPosts', {
        method: 'get',
        url: 'posts'
      });
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
.paginate {
  padding: 30px 0;
  width: 100%;
  display: flex;
  justify-content: center;
}
</style>
