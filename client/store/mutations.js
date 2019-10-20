import Vue from 'vue';
export default {
  setPasswords(state, payload) {
    state.passwords = payload
  },
  setPosts(state, payload) {
    state.posts = payload
  },
  setTasks(state, payload) {
    state.tasks = payload
  },
  setLoading(state, payload) {
    state.loading = payload
  },
  setPasswordsChangeLog(state, payload) {
    state.passwordsChangeLog = payload
  },

  // Pagination
  setPagination(state, payload) {
    state.pagination = payload
  },


  // JsonFields
  addJsonFields(state, obj) {
    state.jsonFields.push(obj)
  },
  removeJsonFields(state, index) {
    state.jsonFields.splice(index, 1)
  },
  clearJsonFields(state) {
    state.jsonFields = [{label: '', value: ''}];
  },
  updateJsonField(state, { index, value }) {
    let oldField = state.jsonFields[index];
    let newField = { label: value.label || oldField.label, value: value.value || oldField.value }
    Vue.set(state.jsonFields, index, newField)
  },
  setJsonFields(state, payload) {
    state.jsonFields = payload;
  },


}