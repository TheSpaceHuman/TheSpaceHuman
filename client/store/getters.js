export default {
  getPasswords: state => {
    return state.passwords
  },
  getPosts: state => {
    return state.posts
  },
  getTasks: state => {
    return state.tasks
  },
  getLoading: state => {
    return state.loading
  },
  getJsonFields: state => {
    return state.jsonFields
  },
  getPasswordsChangeLog: state => {
    return state.passwordsChangeLog
  },
  getPostsChangeLog: state => {
    return state.postsChangeLog
  },
  getPagination: state => {
    return state.pagination
  }
}