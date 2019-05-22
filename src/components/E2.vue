<template>
    <iframe :src="path_ad()" frameborder="0"></iframe>
</template>
<script>
export default {
  methods: {
    'path_ad': function(){
        if($cookies.get('admin') == 'admin'){
            return "http://147.175.121.210:8166/sources/adminSilvia.php"
        }else{
            return "http://147.175.121.210:8166/sources/u2s.php?id=" + $cookies.get('iddb');
        }
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
