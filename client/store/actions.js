export default {
  loadingPasswords(context, axiosOption) {
    context.commit('setLoading', true)
    this.$axios(axiosOption)
    .then((res) => {
      context.commit('setPasswords', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },
  loadingPasswordsChangeLog(context, axiosOption) {
    context.commit('setLoading', true)
    this.$axios(axiosOption)
    .then((res) => {
      context.commit('setPasswordsChangeLog', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },
  loadingPosts(context, axiosOption) {
    context.commit('setLoading', true)
    this.$axios(axiosOption)
    .then((res) => {
      context.commit('setPosts', res.data.data);
      context.commit('setPagination', {links: res.data.links, meta: res.data.meta});
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },
  loadingTasks(context, axiosOption) {
    context.commit('setLoading', true)
    this.$axios(axiosOption)
    .then((res) => {
      context.commit('setTasks', res.data.data);
      context.commit('setLoading', false)
    })
    .catch((e) => {
      console.log(e)
    })
  },


}