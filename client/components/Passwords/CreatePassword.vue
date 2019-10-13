<template>
  <div class="create-password">
    <div class="create-password__action">
      <el-button
        type="success"
        round
        @click="dialogVisible = true"
      >Добавить новый пароль</el-button>
    </div>
    <el-dialog
      title="Создать новый пароль"
      :visible.sync="dialogVisible"
     >
      <form>
        <el-input v-model="title" placeholder="Название пароля" class="form-control"></el-input>
        <JsonFields></JsonFields>
        <el-button type="primary" @click="submitForm">Создать</el-button>
      </form>
    </el-dialog>
  </div>
</template>

<script>
  import JsonFields from '@/components/Passwords/JsonFields.vue'
  export default {
    name: 'CreatePassword',
    components: {
      JsonFields
    },
    data() {
      return {
        dialogVisible: false,
        title: ''
      }
    },
    methods: {
      async submitForm() {
        try {
          const res = await this.$axios({
            headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
            method: 'post',
            url: 'password/store',
            data: {
              title: this.title,
              fields: this.fields
            }
          })
          this.$message({
            showClose: true,
            message: res.data.message,
            type: 'success'
          })
          this.dialogVisible = false

        } catch (e) {
          this.$message({
            showClose: true,
            message: 'Что-то пошло не так!',
            type: 'error'
          })
          console.log(e)
          this.dialogVisible = false
        }
        this.$store.dispatch('loadingPasswords');
        this.$store.commit('clearJsonFields');
       }


      },
    computed: {
      fields() {
        return this.$store.getters.getJsonFields
      }
    }


  }
</script>

<style lang="scss">
.create-password {
  &__action {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-bottom: 20px;
  }
}
</style>