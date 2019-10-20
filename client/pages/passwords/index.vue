<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Passwords</h1>

      <CreatePassword></CreatePassword>

      <el-row>
        <el-col :sm="24">
          <el-form class="search-from">
            <el-form-item  ref="passwordSearchForm" :model="passwordSearchForm">
                <el-input
                  class="search-from__input"
                  v-model="passwordSearchForm.search"
                  placeholder="Введите что ищете"
                >
                <el-button slot="append" icon="el-icon-search"></el-button>
              </el-input>
            </el-form-item>
          </el-form>
        </el-col>
      </el-row>

      <el-row type="flex" style="flex-wrap: wrap;" v-loading="$store.getters.getLoading">
        <el-col
          :sm="{span:24}"
          :md="{span:12}"
          :lg="{span:8}"
          v-for="(password, i) in passwordInSearch"
          :key="i"
          class="password-item-wrapper"
        >
          <el-card class="password-item">
            <div class="password-item__top-line">
              <div class="password-item__top-line__date">
                {{ password['updated_at'] }}
              </div>
              <div class="password-item__top-line__actions">
                <UpdatePassword :password-id="password.id"></UpdatePassword>
                <DeletePassword :password-id="password.id"></DeletePassword>
              </div>
            </div>

            <div class="password-item__title">
              {{ password.title }}
            </div>
            <div class="password-item__fields">
              <p v-for="field in JSON.parse(password.fields)">
                <b>{{ field.label }}:</b> {{ field.value }}
              </p>
            </div>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </el-main>
</template>

<script>
  import UpdatePassword from '@/components/Passwords/UpdatePassword.vue'
  import CreatePassword from '@/components/Passwords/CreatePassword.vue'
  import DeletePassword from '@/components/Passwords/DeletePassword.vue'
  export default {
    name: 'Passwords',
    middleware: 'auth',
    components: {
      CreatePassword, UpdatePassword, DeletePassword
    },
    data() {
      return {
        passwordSearchForm: {
          search: ''
        },
      }
    },
    computed: {
      passwordInSearch() {
        let result = [];
        if(this.passwordSearchForm.search === '') {
          result = this.$store.getters.getPasswords
        } else {
          result = this.$store.getters.getPasswords.filter(element => {
            return element.title.toLowerCase().match(this.passwordSearchForm.search.toLowerCase())
          })
        }
        return result
      },
    },
    created() {
      this.$store.dispatch('loadingPasswords', {
        method: 'get',
        url: 'passwords'
      });
    }
  }
</script>

<style lang="scss">
  .search-from {
    padding: 0 16px 20px;
    &__input {
      width: 100%;
    }
  }
  .password-item {
    &__top-line {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-start;
      &__actions {
        display: flex;
      }
      &__actions > div {
        padding-left: 10px;
      }

      &__date {
        font-size: 14px;
        color: rgba(0,0,0, .7);
      }
    }
    &__title {
      font-weight: 700;
      margin-bottom: 20px;
      font-size: 27px;
    }
    &__fields {
      p {
        display: block;
        margin-bottom: 7px;
        margin-top: 0;
      }
    }
  }
</style>