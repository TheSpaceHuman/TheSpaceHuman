<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Dashboard</h1>
      <el-row>
        <el-col :sm="24" :md="12" :lg="8" v-loading="this.$store.getters.getLoading">
          <h2 class="page__h2">Passwords</h2>
          <el-timeline v-for="passwordLog in this.$store.getters.getPasswordsChangeLog">
            <el-timeline-item :timestamp="passwordLog['updated_at']" placement="top">
              <el-card>
                <h4>{{ passwordLog.type}}</h4>
                <p>{{ passwordLog.message}}</p>
              </el-card>
            </el-timeline-item>
          </el-timeline>
        </el-col>
        <el-col :sm="24" :md="12" :lg="8">
          <h2 class="page__h2">Blog</h2>
          <el-timeline>
            <el-timeline-item timestamp="2018/4/12" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>Tom committed 2018/4/12 20:46</p>
              </el-card>
            </el-timeline-item>
            <el-timeline-item timestamp="2018/4/3" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>Tom committed 2018/4/3 20:46</p>
              </el-card>
            </el-timeline-item>
            <el-timeline-item timestamp="2018/4/2" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>Tom committed 2018/4/2 20:46</p>
              </el-card>
            </el-timeline-item>
          </el-timeline>
        </el-col>
        <el-col :sm="24" :md="12" :lg="8">
          <h2 class="page__h2">TodoList</h2>
          <el-timeline>
            <el-timeline-item timestamp="2018/4/12" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>Tom committed 2018/4/12 20:46</p>
              </el-card>
            </el-timeline-item>
            <el-timeline-item timestamp="2018/4/3" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>Tom committed 2018/4/3 20:46</p>
              </el-card>
            </el-timeline-item>
            <el-timeline-item timestamp="2018/4/2" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>Tom committed 2018/4/2 20:46</p>
              </el-card>
            </el-timeline-item>
          </el-timeline>
        </el-col>
      </el-row>

    </div>
  </el-main>
</template>

<script>

export default {
  name: 'Dashboard',
  components: {},
  created() {
    this.$store.dispatch('loadingPasswordsChangeLog');
  }
}
</script>

<style>

</style>
