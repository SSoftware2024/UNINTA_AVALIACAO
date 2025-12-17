<template>
    <div class="card-layout">
        <div class="card-center">
            <div class="card" style="width: 30rem">
                <div class="card-body">
                    <h3>{{ $route.meta.title }}</h3>
                    <div class="content">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
div.card-layout {
    position: absolute;
    width: 100%;
    height: 100%;
}
div.card-center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
div.content{}
</style>
