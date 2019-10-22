<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Dashboard</h1>
      <el-row>
        <el-col :sm="24" :md="12" :lg="8" v-loading="this.$store.getters.getLoading">
          <h2 class="page__h2">Passwords</h2>
          <el-timeline
            v-for="(passwordLog,passwordIndex) in this.$store.getters.getPasswordsChangeLog"
            :key="passwordIndex"
          >
            <el-timeline-item :timestamp="passwordLog['updated_at']" placement="top">
              <el-card>
                <h4>{{ passwordLog.type}}</h4>
                <p>{{ passwordLog.message}}</p>
              </el-card>
            </el-timeline-item>
          </el-timeline>
        </el-col>
        <el-col :sm="24" :md="12" :lg="8" v-loading="this.$store.getters.getLoading">
          <h2 class="page__h2">Blog</h2>
          <el-timeline
            v-for="(postLog,postIndex) in this.$store.getters.getPostsChangeLog"
            :key="postIndex"
          >
            <el-timeline-item :timestamp="postLog['updated_at']" placement="top">
              <el-card>
                <h4>{{ postLog.type}}</h4>
                <p>{{ postLog.message}}</p>
              </el-card>
            </el-timeline-item>
          </el-timeline>
        </el-col>
        <el-col :sm="24" :md="12" :lg="8">
          <h2 class="page__h2">TodoList</h2>

        </el-col>
      </el-row>

    </div>
  </el-main>
</template>

<script>

export default {
  name: 'Dashboard',
  middleware: 'auth',
  components: {},
  created() {
    this.$store.dispatch('loadingPasswordsChangeLog', {
      method: 'get',
      url: 'logs/passwords'
    });
    this.$store.dispatch('loadingPostsChangeLog', {
      method: 'get',
      url: 'logs/posts'
    });
  }
}
</script>

<style>

</style>
