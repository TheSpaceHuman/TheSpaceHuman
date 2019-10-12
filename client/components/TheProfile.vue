<template>
  <div class="login-registered-dialog">
    <el-tooltip class="item" effect="dark" content="Profile" placement="top-end">
      <a  @click="dialogFormVisible = true">
        <el-avatar size="small" src="https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png"></el-avatar>
      </a>
    </el-tooltip>
    <el-dialog title="Profile" :visible.sync="dialogFormVisible">
      <el-row>
        <el-col :sm="24">
          <div class="user-info">
            <p><b>User:</b> <span>{{ $auth.user.name }}</span></p>
            <p><b>Email:</b> <span>{{ $auth.user.email }}</span></p>
          </div>
          <div class="user-action">
            <el-button type="default" @click="logout">Logout</el-button>
          </div>
        </el-col>
      </el-row>

    </el-dialog>
  </div>
</template>

<script>
  export default {
    name: 'Profile',
    data() {
      return {
        dialogFormVisible: false
      }
    },
    methods: {
      logout() {
        this.$auth.logout();
        this.dialogFormVisible = false
        this.$router.push({name:'auth-login'})
      }
    }
  }
</script>

<style lang="scss">
  .user-info {
    margin-bottom: 40px;
    p {
      font-size: 17px;
      line-height: 1.2;
    }
  }
  .user-action {
    display: flex;
    justify-content: flex-end;
    .el-icon-user {
      color: #fff;
    }
  }
</style>