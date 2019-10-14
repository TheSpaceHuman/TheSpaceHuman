export default {
  loadingPasswords(context) {
    context.commit('setLoading', true)
    this.$axios.get(`password`)
    .then((res) => {
      context.commit('setPasswords', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },
  loadingPasswordsChangeLog(context) {
    context.commit('setLoading', true)
    this.$axios.get(`log`)
    .then((res) => {
      context.commit('setPasswordsChangeLog', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },


}