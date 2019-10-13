export default {
  loadingPasswords(context) {
    this.$axios.get(`password`)
    .then((res) => {
      context.commit('setPasswords', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },

}