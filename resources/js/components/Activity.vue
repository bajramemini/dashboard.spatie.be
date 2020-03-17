<template>
    <tile :position="position">
        <h2>activity</h2>
        <div class="grid gap-padding h-full markup">
            <ul class="align-self-center">
                <li v-for="activity in activities">
                    <div class="my-2">
                        <div :class="{ 'font-bold': withinWeek(event.date) }">{{ event.name }}</div>
                        <div class="text-sm text-dimmed">{{ relativeDate(event.date) }}</div>
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

    props: ['position'],

    data() {
        return {
            activities: [],
        };
    },

    mounted(){
        console.log('activity hier...')
        this.getActivities();
    },

    methods: {
        relativeDate,
        withinWeek,

        getActivities(){
            console.log('get here...')
            const url = window.dashboard.teamworkUrl;
            const token = window.dashboard.teamworkToken;

            window.axios.get(url + 'latestActivity.json',{
                //xsrfHeaderName:null,
                headers:{
                    //'Access-Control-Allow-Origin': '*',
                    //'Content-Type': 'application/json',
                    //'X-Requested-With': 'XMLHttpRequest',
                    },
                    withCredentials:true,
                 auth: {
                username: token,
                password: 'X'
                },
            }) .then(function (response) {
                // handle success
                console.log(response);
            })
        },

        getEventHandlers() {
            return {
                'Calendar.EventsFetched': response => {
                    this.events = response.events;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'activity',
            };
        },
    },
};
</script>
