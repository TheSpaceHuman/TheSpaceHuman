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
                <el-button>Подробно</el-button>
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
          {
            title: 'Category 1',
            content: '<ul>\n' +
              '  <li><a href="#">Link1</a></li>\n' +
              '  <li><a href="#">Link2</a></li>\n' +
              '  <li><a href="#">Link3</a></li>\n' +
              '</ul>'
          },
          {
            title: 'Category 2',
            content: '<ul>\n' +
              '  <li><a href="#">Link1</a></li>\n' +
              '  <li><a href="#">Link2</a></li>\n' +
              '  <li><a href="#">Link3</a></li>\n' +
              '</ul>'
          },
          {
            title: 'Category 3',
            content: '<ul>\n' +
              '  <li><a href="#">Link1</a></li>\n' +
              '  <li><a href="#">Link2</a></li>\n' +
              '  <li><a href="#">Link3</a></li>\n' +
              '</ul>'
          },
        ]
      }
    }
  }
</script>

<style>

</style>
