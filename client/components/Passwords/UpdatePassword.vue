<template>
  <div class="create-password">
    <div class="create-password__action">
      <el-button
        type="warning"
        icon="el-icon-edit"
        circle
        @click="showForm"
      ></el-button>
    </div>
    <el-dialog
      title="Обновить пароль"
      :visible.sync="dialogVisible"
     >
      <form>
        <el-input v-model="title" placeholder="Название пароля" class="form-control"></el-input>
        <JsonFields></JsonFields>
        <el-button type="warning" @click="submitForm">Обновить</el-button>
      </form>
    </el-dialog>
  </div>
</template>

<script>
  import JsonFields from '@/components/Passwords/JsonFields.vue'
  export default {
    name: 'UpdatePassword',
    components: {
      JsonFields
    },
    props: {
      passwordId: {
        type: Number,
        default: 0
      }
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
            method: 'put',
            url: `password/update/${this.passwordId}`,
            data: {
              title: this.title,
              fields: this.fields
            }
          })
          this.$message({
            showClose: true,
            message: res.data.message.body,
            type: res.data.message.type
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
       },
      showForm() {
        this.$store.commit('setJsonFields', JSON.parse(this.password.fields))
        this.title = this.password.title

        this.dialogVisible = true
      }

      },
    computed: {
      password() {
        const statePasswords = this.$store.getters.getPasswords
        const filterArr = statePasswords.filter(password => password.id === this.passwordId)
        return filterArr[0]
      },
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