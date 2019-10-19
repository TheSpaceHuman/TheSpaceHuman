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
    this.$axios.get(`log/passwords`)
    .then((res) => {
      context.commit('setPasswordsChangeLog', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },
  loadingPosts(context) {
    context.commit('setLoading', true)
    this.$axios.get(`post`)
    .then((res) => {
      context.commit('setPosts', res.data.data);
      context.commit('setLoading', false)
      console.log(res.data)
    })
    .catch((e) => {
      console.log(e)
    })
  },
  loadingTasks(context) {
    context.commit('setLoading', true)
    this.$axios.get(`task`)
    .then((res) => {
      context.commit('setTasks', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },


}