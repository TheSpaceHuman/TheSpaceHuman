<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Blog</h1>
      <section class="blog">
        <div class="blog__add-post">
          <nuxt-link :to="{name: 'blog-create'}">
            <el-button type="success" round>Добавить новый пост</el-button>
          </nuxt-link>
        </div>
        <el-row type="flex" class="blog__row" v-loading="$store.getters.getLoading">
          <el-col
            :sm="24"
            :md="12"
            :lg="8"
            v-for="(post,i) in $store.getters.getPosts"
            class="blog__col"
            :key="i"
          >
            <el-card class="blog__card">
              <div class="blog__card__img">
                <img :src="post.image" :alt="post.title">
              </div>
              <div class="blog__card__date">{{ post.updated_at }}</div>
              <h4 class="blog__card__title">{{ post.title }}</h4>
              <p class="blog__card__subtitle">{{ post.body | truncate(110) }}</p>
              <div class="blog__card__actions">
                <el-button
                  type="danger"
                  icon="el-icon-delete"
                  circle
                  @click="deletePost(post.id)"
                ></el-button>
                <nuxt-link :to="{name: 'blog-id-edit', params:{ id: post.id }}">
                  <el-button
                    type="warning"
                    icon="el-icon-edit"
                    circle
                  ></el-button>
                </nuxt-link>
                <nuxt-link :to="{name: 'blog-id-show', params:{ id: post.id }}">
                  <el-button type="primary">Подробно</el-button>
                </nuxt-link>
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
                v-if="!$store.getters.getLoading"
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
    name: 'Posts',
    middleware: 'auth',
    data() {
      return {}
    },
    methods: {
      async deletePost(id) {
        try {
          this.$store.commit('setLoading', true)
          const res = await this.$axios({
            method: 'delete',
            url: `post/${id}/delete`
          })
          this.$store.dispatch('loadingPosts', {
            method: 'get',
            url: 'posts'
          });
          this.$store.commit('setLoading', false)

          this.$message({
            showClose: true,
            message: res.data.message.body,
            type: res.data.message.type
          })
        } catch (e) {
          console.log(e)
        }
      },
      changePage(page) {
        this.$store.dispatch('loadingPosts', {
          method: 'get',
          url: 'posts',
          params: {
            page: page
          }
        });
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

  &__add-post {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 20px;
    padding-bottom: 20px;
  }

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
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 20px;
    }
    &__subtitle {
      margin-top: 0;
      margin-bottom: 20px;
      font-weight: 300;
    }
    &__tags {
      padding: 20px 0;
      font-weight: 400;
      font-size: 17px;
      text-align: right;
    }
    &__actions {
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }
    &__actions > button,  &__actions > a {
      margin: 0 7px;
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
