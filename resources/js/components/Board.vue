<template>
    <tile :position="position">
        <div class>
            <h2>{{ title(this.board) }}</h2>
            <ul class>
                <li v-for="task in tasks">
                    <div class="my-2 text-sm">
                        <li class="bg-gray-900 rounded mb-2 p-4 overflow-hidden">
                            <strong class="hidden">{{ task.progress}}</strong>
                            {{ task.name }}
                            <small>{{ task.created_at }}</small>

                            <small class="flex mt-2" v-for="user in task.users">
                                <img :src="user.avatarUrl" alt class="w-4 h-4 rounded-full mr-2" />
                                <span class="opacity-25">{{ user.firstName }}</span>
                            </small>
                        </li>
                    </div>
                </li>
            </ul>
        </div>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import { relativeDate, withinWeek } from '../helpers';

export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position', 'board'],

    data() {
        return {
            tasks: [],
        };
    },

    mounted() {
        this.getTasks();
    },

    methods: {
        getTasks() {
            axios.get('/api/teamwork/projekte/board/' + this.board).then(response => {
                this.tasks = response.data;
            });
        },

        title() {
            var item = this.board;

            return item
                .split('_')
                .map(function(item) {
                    return item.charAt(0).toUpperCase() + item.substring(1);
                })
                .join(' ');
        },

        getEventHandlers() {
            // return {
            //     'Calendar.EventsFetched': response => {
            //         this.events = response.events;
            //     },
            // };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'board-' + this.board,
            };
        },
    },
};
</script>
