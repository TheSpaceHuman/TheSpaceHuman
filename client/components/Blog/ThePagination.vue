<template>
  <nav class="the-pagination el-pagination is-background">
    <button type="button" class="btn-prev the-pagination__btn-prev"><i class="el-icon el-icon-arrow-left"></i></button>

    <ul class="el-pager">
      <li class="number active">1</li>
      <li class="number">2</li>
    </ul>

    <button type="button" class="btn-next"><i class="el-icon el-icon-arrow-right"></i></button>



    <el-pagination
      background
      layout="prev, pager, next"
      :total="30">
    </el-pagination>
  </nav>
</template>

<script>
  export default {
    props: {
      links: {
        type: Object,
        default: function () {
          return {
            first: 'http://thespacehuman.web/api/post?page=1',
            last: 'http://thespacehuman.web/api/post?page=3',
            next: 'http://thespacehuman.web/api/post?page=2',
            prev: null,
          }
        }
      },
      meta: {
        type: Object,
        default: function () {
          return {
            current_page: 1,
            from: 1,
            last_page: 3,
            path: 'http://thespacehuman.web/api/post',
            per_page: 12,
            to: 12,
            total: 30,

          }
        }
      }
    },
    data() {
      return {}
    }
  }
</script>

<style lang="scss">
  .the-pagination {

  }
</style>