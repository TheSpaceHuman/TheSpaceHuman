<template>
  <div class="delete-password">
    <div class="delete-password__action">
      <el-button
        type="danger"
        icon="el-icon-delete"
        circle
        @click="dialogVisible = true"
      ></el-button>
      <el-dialog
        title="Удаление пароля"
        :visible.sync="dialogVisible"
        >
        <span>Вы точно хотите удалить данный пароль?</span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="dialogVisible = false">Нет</el-button>
          <el-button type="primary" @click="submitForm">Да</el-button>
        </span>
      </el-dialog>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'DeletePassword',
    props: {
      passwordId: {
        type: Number,
        default: 0
      }
    },
    data() {
      return {
        dialogVisible: false,

      }
    },
    methods: {
      async submitForm() {
        this.dialogVisible = false
        try {
          const res = await this.$axios({
            headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
            method: 'delete',
            url: `password/delete/${this.passwordId}`,
          })
          this.$message({
            showClose: true,
            message: res.data.message.body,
            type: res.data.message.type
          })
        } catch (e) {
          this.$message({
            showClose: true,
            message: 'Что-то пошло не так!',
            type: 'error'
          })
          console.log(e)
        }
        this.$store.dispatch('loadingPasswords');
       },
      alert() {

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