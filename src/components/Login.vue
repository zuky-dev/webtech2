<template>
    <form method="POST" @submit.prevent="login">
        <h1>{{$cookies.get('lang') == 'en' ? 'Login page' : 'Prihlasenie'}}</h1>
        <input type="text" name="acc" v-model="acc" :placeholder="$cookies.get('lang') == 'en' ? 'Account' : 'Prihlasovacie meno'">
        <input type="password" name="pswd" v-model="pswd" :placeholder="$cookies.get('lang') == 'en' ? 'Pasword' : 'Heslo'">
        <button type="submit">{{$cookies.get('lang') == 'en' ? 'Log in' : 'Prihlasit sa'}}</button>
        <ul id="flags">
          <li v-on:click="change('sk')" id='sk' :class="$cookies.get('lang') == 'en' ? 'inactive' : ''"><img src="../assets/images/sk.gif" alt="slovak"></li>
          <li v-on:click="change('en')" id='en' :class="$cookies.get('lang') == 'en' ? '' : 'inactive'"><img src="../assets/images/en.gif" alt="english"></li>
        </ul>
    </form>
</template>
<script>
import axios from 'axios';

export default {
  methods: {
    'login': function(e){
        axios.get('http://147.175.121.210:8166/api/login/' + this.acc + '/' + this.pswd).then(response => {
            console.log(response.data);
            let data = response.data;
            if(data.conn){
                $cookies.set('id', data.id);
                $cookies.set('iddb', data.iddb);
                $cookies.set('admin', data.admin);
                $cookies.set('name', data.name);
                $cookies.set('surname', data.surname);

                location.reload();
            }else{
                alert('Something went wrong');
            }
        });
    },
    change: function(lang){
      if(lang == 'en'){
        $cookies.set('lang','en');
      }else{
        $cookies.set('lang','sk');
      }
      location.reload();
    }
  },
  data () {
    return {
        acc: null,
        pswd: null
    }
  },
}
</script>
<style lang="scss" scoped>
@import '../scss/responsive.scss';

h1{
    margin: 1rem;
}

input, button{
    outline: none;
    border: none;
    border-radius: 15px;
    width: 80%;
    margin: .5rem 10%;
    text-align: center;
    background: #eaeaea;
    color: #161616;
    padding: .5rem 0;
    transition: 300ms all ease-in-out;
    &:hover{
        background: #242424;
        color: white;
    }
}

button{
    width: 40%;
    margin: .5rem 30%;
    margin-bottom: 1.5rem;
    color: white;
    background: rgb(73, 127, 226);
    cursor: pointer;

    &:hover{
        background: rgb(6, 53, 141);
    }
}

#main{
    width: 60%;
    height: 60vh !important;
    min-height: 60vh !important;
    margin: 20vh 20%;
    border-radius: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background: #eaeaea;
}
@media #{$tablet}{
  #main{
    width: 80%;
    height: 80vh !important;
    min-height: 80vh !important;
    margin: 10vh 10%;
  }
}
@media #{$phone}{
  #main{
    width: 100%;
    height: 100vh !important;
    min-height: 100vh !important;
    margin: 0;
  }
}

#flags{
  display: flex;
  justify-content: center;
  width: 100%;
  li{
    width: 10%;
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