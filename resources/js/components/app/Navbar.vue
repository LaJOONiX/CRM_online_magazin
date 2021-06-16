
<template>
  <nav class="navbar indigo lighten-5">
    <div class="nav-wrapper">
      <div class="navbar-left">
        <router-link class="logo" to="/">
          <i class="material-icons logo__img">layers</i>
          <span class="logo__text">OFFICE</span>
        </router-link>
        <a href="#" @click.prevent="$emit('click')">
          <i class="material-icons black-text">dehaze</i>
        </a>
      </div>

      <ul class="right hide-on-small-and-down">
        <li>
          <a class="dropdown-trigger black-text" href="#" data-target="dropdown" ref="dropdown">
            {{name}}
            <i class="material-icons right">arrow_drop_down</i>
          </a>

          <ul id="dropdown" class="dropdown-content">
            <li>
              <router-link to="/profile" class="black-text">
                <i class="material-icons">account_circle</i>
                {{'ProfileTitle'|localize}}
              </router-link>
            </li>
            <li class="divider" tabindex="-1"></li>
            <li>
              <a href="#" class="black-text" @click.prevent="logout">
                <i class="material-icons">assignment_return</i>
                {{'Exit'|localize}}
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    date: new Date(),
    interval: null,
    dropdown: null
  }),
  methods: {
    logout() {
      this.$store.dispatch('auth_logout')
    }
  },
  computed: {
    name() {
      return this.$initials(this.$store.getters.authUser.name)
    }
  },
  mounted() {
    let elems = document.querySelectorAll('.sidenav');
    let instances = M.Sidenav.init(elems);
    this.interval = setInterval(() => {
      this.date = new Date()
    }, 1000)
    this.dropdown = M.Dropdown.init(this.$refs.dropdown, {
      constrainWidth: false
    })
  },
  beforeDestroy() {
    clearInterval(this.interval)
    if (this.dropdown && this.dropdown.destroy) {
      this.dropdown.destroy()
    }
  }
}
</script>

<style scoped>
  .logo__text {
    margin-left: 9px;
    font-family: Quantico, sans-serif;
    font-size: 20px;
    letter-spacing: 0.12em;
  }

  .logo__img, .logo__text {
    display: inline-block;
    vertical-align: middle;
    color:black
  }

  .logo__img {
    font-size: 48px;
    color:#262626;
  }

</style>

