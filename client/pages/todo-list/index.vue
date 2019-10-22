<template>
  <el-main class="main">
    <div class="container">
      <h1 class="page__h1">TodoList</h1>
      <section class="todo-list">
        <div class="todo-list__timer">
          {{ currentTime | date }}
        </div>
        <div class="todo-list__add-task">
          <nuxt-link :to="{name: 'todo-list-create'}">
            <el-button type="success" round>Создать новую задачу</el-button>
          </nuxt-link>
        </div>
        <el-row >
          <el-col
            :sm="24"
            :md="12"
            :lg="8"
          >
          </el-col>
        </el-row>
      </section>
    </div>
  </el-main>
</template>


<script>

  export default {
    name: 'Tasks',
    middleware: 'auth',
    components: {},
    data() {
      return {
        currentTime: new Date()
      }
    },
    filters: {
      date: function (value) {
        const dateObj = {
          yea: value.getFullYear(),
          month: value.getMonth() + 1,
          day: value.getDate(),
          hour: value.getHours(),
          minute: value.getMinutes(),
          second: value.getSeconds(),
        }
        return `${dateObj.day}-${dateObj.month}-${dateObj.day} ${dateObj.hour}:${dateObj.minute}:${dateObj.second}`
      }
    },
    methods: {
      time() {
        setInterval(() => {
          this.currentTime = new Date()
        }, 1000)
      }
    },
    mounted() {
      this.time()
    }
  }
</script>

<style lang="scss">
.todo-list {
  @import "@/assets/scss/utils/vars";

  &__add-task {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
  }
  &__timer {
    color: $--color-primary;
    font-size: 28px;
    text-align: center;
    padding: 0 20px 20px;
  }
}
</style>
