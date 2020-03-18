<template>
    <tile :position="position">
        <div class="">
            <h2>Meilensteine</h2>
            <ul class="">
                <li v-for="milestone in milestones">
                    <div class="my-2 text-sm">
                       <li class="bg-gray-800 text-white rounded mb-2 p-4">
                           {{ milestone.title }} <br>
                           <small >
                               <strong class=" ">Deadline</strong>
                           {{ milestone.deadline }}
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

    props: ['position'],

    data() {
        return {
            milestones: [],
        };
    },

    mounted(){
        this.getMilestones();
    },

    methods: {
        getMilestones() {
            axios.get('/api/teamwork/milestones').then(response => {
                this.milestones = response.data
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
                cacheKey: 'milestones',
            };
        },
    },
};
</script>
