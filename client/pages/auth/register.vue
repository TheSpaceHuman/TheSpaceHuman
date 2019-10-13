<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Registration</h1>
      <div class="login-registered-dialog">
        <el-row>
          <el-col :sm="24" :md="{span: 12, offset: 6}" :lg="{span: 12, offset: 6}">
            <el-form :model="registerForm">
              <el-form-item label="Name">
                <el-input v-model="registerForm.name" placeholder="Имя" class="form-control" name="name"></el-input>
              </el-form-item>
              <el-form-item label="E-mail">
                <el-input v-model="registerForm.email" placeholder="Email" class="form-control" name="email"></el-input>
              </el-form-item>
              <el-form-item label="Пароль">
                <el-input v-model="registerForm.password" placeholder="Пароль" type="password" class="form-control" name="password"></el-input>
              </el-form-item>
              <div class="login-registered-dialog__action">
                <el-button type="primary" @click="register">Зарегестрироваться</el-button>
                <nuxt-link :to="{name: 'auth-login'}">Войти</nuxt-link>
              </div>
            </el-form>
          </el-col>
        </el-row>
      </div>
    </div>
  </el-main>

</template>

<script>
  export default {
    name: 'Registration',
    data() {
      return {
        registerForm: {
          name: '',
          email: '',
          password: '',
        }
      }
    },
    methods: {
      async register () {
        try {
          const res = await this.$axios({
              headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
              method: 'post',
              url: '/auth/registration',
              data: this.registerForm
            })
          this.$message({
            showClose: true,
            message: res.data.message,
            type: 'success'
          })

          this.registerForm.name = ''
          this.registerForm.email = ''
          this.registerForm.password = ''

          this.$router.push({name: 'auth-login'})
        } catch (e) {
          this.$message({
            showClose: true,
            message: 'Что-то пошло не так!',
            type: 'error'
          })
          console.log(e)
        }
      }
    }
  }
</script>

<style lang="scss">
  .login-registered-dialog {

    &__action {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  }
</style>