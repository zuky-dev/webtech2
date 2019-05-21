<template>
    <iframe v-if="$cookies.get('admin')" src="http://147.175.121.210:8166/sources/adminSilvia.php" frameborder="0"></iframe>
    <iframe v-else src="http://147.175.121.210:8166/sources/u2s.php" frameborder="0"></iframe>
</template>
<script>
</script>
<style lang="scss" scoped>
</style>
