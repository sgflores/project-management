<template>
    <div class="container-fluid">
        
        <navigation></navigation>
        
        <main role="main">

            <div class="main-container-body">
                <router-view></router-view>
            </div>

        </main><!-- /.container -->

    </div>
</template>

<script>
import Navbar from './components/Navbar';
export default {
    components: {
        'navigation': Navbar
    },
    created() {

    }
}
</script>