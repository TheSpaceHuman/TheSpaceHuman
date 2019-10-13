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
        <el-input v-model="passwordForm.title" placeholder="Название пароля" class="form-control"></el-input>
        <JsonFields @fields="updateFields"></JsonFields>
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
        passwordForm: {
          title: '',
          fields: [],
        }
      }
    },
    methods: {
      updateFields(data) {
        this.passwordForm.fields = data
      },
      async submitForm() {
        try {
          const res = await this.$axios({
            headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
            method: 'post',
            url: 'password/store',
            data: this.passwordForm
          })
          this.$message({
            showClose: true,
            message: res.data.message,
            type: 'success'
          })

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
.create-password {
  &__action {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-bottom: 20px;
  }
}
</style>