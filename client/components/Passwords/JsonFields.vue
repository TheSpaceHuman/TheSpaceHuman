<template>
  <div class="json-fields">
    <div class="json-fields__items">
        <JsonField
          v-for="(item,i) in fields"
          :key="i"
          :field="item"
          :visibilityDestroyAction="visibilityDestroyAction"
          :index="i"
        ></JsonField>
      </div>
    <div class="json-fields__action">
      <el-button
        type="success"
        round
        @click="addField"
      >{{ addButtonName }}</el-button>
    </div>
  </div>
</template>

<script>
  import JsonField from '@/components/Passwords/JsonField.vue'
  export default {
    name: 'JsonFields',
    components: {
      JsonField
    },
    props: {
      addButtonName: {
        default: 'Добавить поле'
      }
    },
    data() {
      return {}
    },
    computed: {
      visibilityDestroyAction() {
        if (this.fields.length > 1) {
          return true
        }
        return false
      },
      fields() {
        return this.$store.getters.getJsonFields
      }
    },
    methods: {
      addField() {
        this.$store.commit('addJsonFields', {label: '', value: ''})
      }
    }
  }
</script>

<style lang="scss">
.json-fields {
  &__item {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    &__label {
      padding: 10px;
      flex: 1 1 40%;
      line-height: 2;

      &__label-control {

      }
      &__value-control {

      }
    }
    &__delete {
      margin-top: 24px;
      padding: 10px;
      flex: 0 0 auto;
    }
  }
  &__action {
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>