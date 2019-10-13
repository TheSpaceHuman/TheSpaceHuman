<template>
  <div class="json-fields">
    <div class="json-fields__items">
      <div class="json-fields__item"
        v-for="(item,i) in fields"
        :key="i"
        >
        <label class="json-fields__item__label">
          {{ pattern.label }}
          <el-input
            :label="pattern.label"
            class="json-fields__item__label__label-control"
            v-model="item.label"
          ></el-input>
        </label>
        <label class="json-fields__item__label">
          {{ pattern.value }}
          <el-input
            :label="pattern.value"
            class="json-fields__item__label__value-control"
            v-model="item.value"
          ></el-input>
        </label>

        <el-button
          v-if="visibilityDestroyAction"
          type="danger"
          icon="el-icon-delete"
          circle
          class="json-fields__item__delete"
          @click="deleteField(i)"
        ></el-button>
      </div>
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
  export default {
    name: 'JsonFields',
    props: {
      pattern: {
        type: Object,
        default: function () {
          return {
            label: 'Название параметра',
            value: 'Значение'
          }
        }
      },
      addButtonName: {
        default: 'Добавить поле'
      }
    },
    data() {
      return {
        fields: [],
        mock: {
          label: '',
          value: ''
        }
      }
    },
    computed: {
      visibilityDestroyAction() {
        if (this.fields.length > 1) {
          return true
        }
        return false
      }
    },
    methods: {
      addField() {
        this.fields.push(this.mock)
        this.$emit('fields', this.fields)
      },
      deleteField(id) {
        this.fields.splice(id, 1)
        this.$emit('fields', this.fields)
      }
    },
    mounted() {
      this.fields.push(this.mock)
      this.$emit('fields', this.fields)
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