<template>
    <div class="pagination">
        <ul class="pagination">
            <li><a href="#" :disabled="currentPage == 1">Prev</a></li>
            <li v-for="(n,index) in range(1,lastPage)" :class="n==currentPage ? 'active' : ''"><a href="#" class="active" @click="paginate(n)">{{ n }}</a></li>
            <li><a href="#">Next</a></li>
        </ul>
    </div>
</template>

<script>

    export default {
        props: {
            currentPage: {
                type: Number,
                default: 1,
            },
            lastPage: {
                type: Number,
                default: 10,
            },
        },
        data: function() {
            return {
            };
        },
        computed: {

        },

        methods: {
            paginate: function(page){
                this.$emit('select', page);
            },
            range: function(start,end){
                let array = [];
                for(let i=start; i<=end; i++){
                    array.push(i);
                }
                return array;
            }
        },
        created: function() {

        },
        mounted() {

        },
    };
</script>
