<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">Passwords</h1>
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

      <el-row>
        <el-col
          :sm="24"
          :md="12"
          :lg="8"
          v-for="(card, i) in showPassword"
          :key="i"
          class="password-item-wrapper"
        >
          <el-card class="password-item">
            <div class="password-item__title">
              Title - {{ card.title }}
            </div>
            <div class="password-item__name">
              Login - {{ card.name }}
            </div>
            <div class="password-item__password">
              Password - {{ card.password }}
            </div>
          </el-card>
        </el-col>
      </el-row>
    </div>
  </el-main>
</template>

<script>

  export default {
    name: 'Passwords',
    data() {
      return {
        autocompleteList: [],
        passwordSearchForm: {
          search: ''
        },
        passwords: [
          { title: 'Adsad', name: 'Name1', password: '12345'},
          { title: 'Bcxvz', name: 'Name2', password: '12345'},
          { title: 'Cgf4dsg', name: 'Name3', password: '12345'},
          { title: 'Ds23ad', name: 'Name4', password: '12345'},
          { title: 'Fcxz', name: 'Name5', password: '12345'},
          { title: 'Gqwet2423', name: 'Name6', password: '12345'},
        ]
      }
    },
    methods: {
      querySearch(queryString, cb) {
        let autocompleteList = this.autocompleteList;
        let results = queryString ? autocompleteList.filter(this.createFilter(queryString)) : autocompleteList;
        cb(results);
      },
      createFilter(queryString) {
        return (link) => {
          return (link.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
        };
      },
      passwordsData() {
        let acData = [];
        this.passwords.forEach(el => {
          acData.push({"value": el.title})
        });
        return acData
      }

    },
    computed: {
      showPassword() {
        let result = [];
        if(this.passwordSearchForm.search === '') {
          result = this.passwords
        } else {
          result = this.passwords.filter(element => {
            return element.title.toLowerCase().match(this.passwordSearchForm.search.toLowerCase())
          })
        }
        return result
      },
    },
    mounted() {
      this.autocompleteList = this.passwordsData();
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
</style>