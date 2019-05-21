<template>
  <div id="main" v-if="$cookies.isKey('id')">
    <heading id="menu"></heading>
    <!--footing id="footer"></footing-->
    <router-view id="content"><router-view/>
  </div>
  <loger id="main" v-else></loger>
</template>

<script>
import Header from './partials/Header.vue';
import Login from './Login.vue';

export default {
  components: {
    'heading': Header,
    'loger': Login,
  },
  mounted: getCookie()
}

function getCookie(){
  if(!$cookies.isKey('lang')){
    $cookies.set('lang','sk');
  }
  $cookies.set('uType','admin');
}

</script>

<style lang="scss">
@import '../scss/responsive.scss';

body{
  background: #161616;
}

#main{
  width: 100%;
  min-height: 100vh;
}
#menu{
  background: #161616;
  position: fixed;
  width: 20vw;
  height: 100vh;
  top: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
#content{
  background: #eaeaea;
  width: 80vw;
  min-height: 100vh;
  margin-left: 20vw;
}

@media print{
  #menu{
    display: none
  }
  #content{
    width: 100vw;
    min-height: 100vh;
    margin-left: 0vw;
  }
}

@media #{$tablet}{
  #menu{
    width: 100%;
    height: fit-content;
    position: initial;
  }
  #content{
    width: 100vw;
    min-height: 100vh;
    margin-left: 0vw;
  }

}
@media #{$phone}{
  #menu{
    width: 100%;
    height: fit-content;
    position: initial;
  }
  #content{
    width: 100vw;
    min-height: 100vh;
    margin-left: 0vw;
  }

}

</style>