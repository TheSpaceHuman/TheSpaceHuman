<template>
  <div class="json-fields__item">
    <label class="json-fields__item__label">
      {{ labelTitle }}
      <el-input
        :label="labelTitle"
        class="json-fields__item__label__label-control"
        v-model="cLabel"
      ></el-input>
    </label>
    <label class="json-fields__item__label">
      {{ valueTitle }}
      <el-input
        :label="valueTitle"
        class="json-fields__item__label__value-control"
        v-model="cValue"
      ></el-input>
    </label>
    <el-button
      v-if="visibilityDestroyAction"
      type="danger"
      icon="el-icon-delete"
      circle
      class="json-fields__item__delete"
      @click="deleteField(index)"
    ></el-button>
  </div>
</template>

<script>
  export default {
    name: 'JsonField',
    props: {
      index: {
        default: 0
      },
      visibilityDestroyAction: {
        default: false
      },
      labelTitle: {
        default: 'Название параметра'
      },
      valueTitle: {
        default: 'Значение'
      },
      field: {
        default: function () {
          return {
            label: '',
            value: ''
          }
        }
      }
    },
    data() {
      return {
        item: null
      }
    },
    methods: {
      deleteField(index) {
        this.$store.commit('removeJsonFields', index)
      }
    },
    computed: {
      cLabel: {
        get() {
          return this.$store.getters.getJsonFields[this.index] && this.$store.getters.getJsonFields[this.index].label || ''
        },
        set(value) {
          this.$store.commit('updateJsonField', { index: this.index, value: {label:value}})
        }
      },
      cValue: {
        get() {
          return this.$store.getters.getJsonFields[this.index] && this.$store.getters.getJsonFields[this.index].value || ''
        },
        set(value) {
          this.$store.commit('updateJsonField', { index: this.index, value: {value}})
        }
      }
    }
  }
</script>

<style lang="scss">

</style>