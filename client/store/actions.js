export default {
  user({commit}) {
    return this.$axios('auth/me');
  }
}