<template>
    <tile :position="position">
        <div class="grid h-full">
            <h2>Aktivität</h2>
            <ul class="">
                <li v-for="activity in activities">
                    <div class="my-2 text-sm">
                       <li>
                           <small class="text-gray-500">
                               <img :src="activity.user_img" alt="" class="w-4 h-4 rounded-full">
                               {{ activity.user }}
                               </small>
                               <strong>{{ activity.type}} {{ activity.activity}} </strong> <br>
                           {{ activity.description }} <br>
                           <small>{{ activity.created_at }}</small>
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

        getActivities() {
            axios.get('/api/teamwork/activity').then(response => {
                this.activities = response.data
                });

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
                cacheKey: 'activity',
            };
        },
    },
};
</script>
