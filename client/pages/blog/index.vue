<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Blog</h1>
      <section class="blog">
        <el-row>
          <el-col
            :sm="24"
            :md="12"
            :lg="8"
          >
            <el-card class="blog__card">
              <div class="blog__card__img">
                <img src="" alt="">
              </div>
              <h4 class="blog__card__title"></h4>
              <p class="blog__card__subtitle"></p>
              <div class="blog__card__actions">
              </div>
            </el-card>
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
    components: {},
    data() {
      return {
        wikiCategories: [

        ]
      }
    }
  }
</script>

<style>

</style>
