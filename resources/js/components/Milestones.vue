<template>
    <tile :position="position">
        <div class="">
            <div class="flex items-center">
                <img src="/images/mission.svg" class="w-8 mr-2">
            <h2>Meilensteine</h2>
            </div>
            <ul class="">
                <li v-for="milestone in milestones">
                    <div class="my-2 text-sm">
                       <li class="rounded mb-2 p-4 flex justify-between" :class="[milestone.past ? 'bg-red-200' : 'bg-green-200']">
                           <div>
                               <span class="block font-bold">
                               {{ milestone.title }}
                           </span>
                           <small >

                               <strong class=" ">Deadline</strong>
                           {{ milestone.deadline }}
                           </small>
                           </div>

                           <img src="/images/attention.svg" class="w-6" v-if="milestone.past">
                           <img src="/images/medal.svg" class="w-6" v-if="!milestone.past">
                           <!-- <img src="/images/flag_full.svg" class="w-6" v-if="!milestone.past"> -->
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
