<template>
    <div>
        <list :list="list" v-for="list in lists.data" :key="list.id"></list>

        <div class="List">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="newList.name" placeholder="Ny liste">
                    <span class="input-group-btn">
                    <button class="btn btn-default" @click.prevent="create">
                        <i class="fa fa-check"></i>
                    </button>
                  </span>
                </div>
            </form>
        </div>
    </div>
</template>

<style lang="less">
    .List {
        width: 180px;
        float: left;
        margin-left: 20px;

    .btn {
        height: 36px;
    }
    }
</style>

<script type="text/babel">
    export default {
        props: [],

        data() {
            return {
                newList: {
                    name: ''
                },
                lists: {
                    data: []
                }
            }
        },

        created() {
            axios.get(this.endpoint).then((response) => this.lists = response.data);

            Echo.private('team.' + Spark.state.currentTeam.id)
                .listen('ListCreated', (event) => {
                    this.lists.data.push(event.list)
                })
                .listen('CardCreated', (event) => {
                    this.lists.data.forEach((list, idx) => {
                        if (list.id === event.card.list_id) {
                            this.lists.data[idx].cards.push(event.card);
                        }
                    });
                })
        },

        methods: {
            create() {
                axios.post(this.endpoint, this.newList).then(() => {
                    this.newList.name = '';
                });
            }
        },

        computed: {
            endpoint() {
                return '/api/lists';
            }
        }
    }
</script>