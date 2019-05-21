  <template>
    <header>
      <div>
        <span id="toptxt">{{ $cookies.get('lang') == 'en' ? 'Logged in as:' : 'Prihlaseny ako:'}}</span>
        <h1 id="nametxt">{{ $cookies.get('name') + ' ' + $cookies.get('surname') }}</h1>

        <nav id="nav">
          <navigation :path="''" :node="$router.options.routes"></navigation>
          <button v-on:click="logout" id="logout">{{ $cookies.get('lang') == 'en' ? 'Logout' : 'Odhlasit sa'}}</button>
        </nav>
      </div>
      <div>
        <ul id="flags">
          <li v-on:click="change('sk')" id='sk' :class="$cookies.get('lang') == 'en' ? 'inactive' : ''"><img src="../../assets/images/sk.gif" alt="slovak"></li>
          <li v-on:click="change('en')" id='en' :class="$cookies.get('lang') == 'en' ? '' : 'inactive'"><img src="../../assets/images/en.gif" alt="english"></li>
        </ul>
        <footing></footing>
      </div>
    </header>
</template>
<script>
import Navigation from "./Navigation";
import Footer from './Footer.vue';

export default {
  components: {
    'navigation': Navigation,
    'footing' : Footer
  },
  data () {
    return {
    }
  },
  methods:{
    logout: function(){
      $cookies.remove('id');
      $cookies.remove('name');
      $cookies.remove('surname');
      $cookies.remove('iddb');
      $cookies.remove('admin');
      location.reload();
    },
    change: function(lang){
      if(lang == 'en'){
        $cookies.set('lang','en');
      }else{
        $cookies.set('lang','sk');
      }
      location.reload();
    },
  }
}
</script>
<style lang="scss" scoped>
@import '../../scss/responsive.scss';

#toptxt{
  margin: 2rem 10% 0 10%;
  width: 80%;
}
#nametxt{
  margin: 0 10% 3rem 10%;
  width: 80%;
  overflow: hidden;
}
#toptxt,#nametxt{
  color: white;
}

#logout{
  outline: none;
  border: none;
  border-radius: 15px;
  width: 80%;
  margin: 0 10%;
  text-align: center;
  background: rgb(146, 11, 11);
  color: white;
  padding: .5rem 0;
  cursor: pointer;
  transition: 300ms all ease-in-out;

  &:hover{
    background: rgb(241, 12, 12);
  }
}

#flags{
  display: flex;
  justify-content: center;
  width: 100%;
  li{
    width: 40%;
    cursor: pointer;
    transition: 300ms all ease-in-out;
    &.inactive{
      opacity: .4;
    }

    &:hover{
      opacity: .75;
    }

    &:nth-child(1) img{
      border-top-left-radius: 15px;
      border-bottom-left-radius: 15px;
    }
    &:nth-child(2) img{
      border-top-right-radius: 15px;
      border-bottom-right-radius: 15px;
    }

    img{
      width: 100%;
      height: 5vh;
      object-fit: cover
    }
  }
}
</style>
