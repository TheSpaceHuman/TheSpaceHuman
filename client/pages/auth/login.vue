<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Login</h1>
      <div class="login-registered-dialog">
        <el-row>
          <el-col :sm="24" :md="{span: 12, offset: 6}" :lg="{span: 12, offset: 6}">
            <el-form :model="loginForm">
              <el-form-item label="E-mail">
                <el-input v-model="loginForm.email" placeholder="Введите вашу почту" class="form-control"></el-input>
              </el-form-item>
              <el-form-item label="Пароль">
                <el-input v-model="loginForm.password" placeholder="Введите пароль" type="password" class="form-control"></el-input>
              </el-form-item>
              <div class="login-registered-dialog__action">
                <el-button type="primary"  @click="login">Войти</el-button>
                <nuxt-link :to="{name: 'auth-register'}">Зарегистрироваться</nuxt-link>
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
    name: 'Login',
    data() {
      return {
        loginForm: {
          email: '',
          password: '',
        }
      }
    },
    methods: {
      async login() {
        try {
          const data = { email: this.loginForm.email, password: this.loginForm.password }
          await this.$auth.loginWith('local', { data: data })
        } catch (e) {
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