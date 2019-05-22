<template>
    <ul id="navLinks">
        <li v-for="(link,i1) in availableLinks" :key="i1">
            <router-link class="" :to="path + link.path">
                <span class="">{{$cookies.get('lang') =='en' ? link.meta.en : link.meta.sk}}</span>
            </router-link>
        </li>
    </ul>
</template>
<script>
export default {
    name: "node",
    props: {
        node: Array,
        path: "",
    },
    computed:{
        availableLinks: function() {
            return this.node.filter(function(u) {
                let res = u.meta.users == 'all' ? true : (u.meta.users == $cookies.get('admin') ? true : false);
                return res;
            })
        }
    },
    methods: {
        dropdown(idIcon,idMenu){
            $('#'+idIcon).toggleClass('open').parent().toggleClass('open');
            $('#'+idMenu).toggleClass('hidden');
        },
        removeWhitespace(text){
            return text.replace(/\s/g, '_');
        }
    }

};

</script>
<style lang="scss" scoped>
    #navLinks{
        li{
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
}
</style>
