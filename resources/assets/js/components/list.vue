<template>
    <div class="List">
        <h5>{{ list.name }}</h5>

        <div class="Card" v-for="card in list.cards" :key="card.id">
            <div class="col-xs-12 well well-sm">
                {{ card.title }}
            </div>
        </div>

        <form>
            <div class="input-group">
                <input type="text" class="form-control" v-model="newCard.title" placeholder="Nyt card">
                <span class="input-group-btn">
                <button class="btn btn-default" @click.prevent="create">
                    <i class="fa fa-check"></i>
                </button>
              </span>
            </div>
        </form>
    </div>
</template>

<style lang="less">
    .Card .well {
        background-color: white;
    }
</style>

<script type="text/babel">
    export default {
        props: ['list'],

        data() {
            return {
                newCard: {
                    title: '',
                },
            }
        },

        created() {
        },

        methods: {
            create() {
                axios.post(this.endpoint, this.newCard).then(() => {
                    this.newCard.title = '';
                });
            }
        },

        computed: {
            endpoint() {
                return '/api/lists/' + this.list.id + '/cards';
            }
        }
    }
</script>