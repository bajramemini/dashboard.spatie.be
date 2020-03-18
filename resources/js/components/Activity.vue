<template>
    <tile :position="position">
        <div class="grid h-full">
            <h2>Aktivität</h2>
            <ul class>
                <li v-for="activity in activities">
                    <div class="my-2 text-sm">
                        <li class="mb-6">
                            <small class="flex justify-between">
                             <div class="flex">
                                    <img
                                    :src="activity.user_img"
                                    alt
                                    class="w-4 h-4 rounded-full mr-2 opcaity-100"
                                />
                                <!-- <span class="mr-2 opacity-25">{{ activity.user }}</span> -->
                                <strong
                                    class="mr-4 opacity-25"
                                >{{ formatActivityText(activity.type, activity.activity)}}</strong>
                             </div>
                                  <small
                                    class="text-xs opacity-25 text-right"
                                >{{ activity.created_at }}</small>
                            </small>
                            <div class="flex flex-col mt-2">
                                <span>{{ activity.description }}</span>
                            </div>
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

    mounted() {
        console.log('activity hier...');
        this.getActivities();
    },

    methods: {
        relativeDate,
        withinWeek,

        getActivities() {
            axios.get('/api/teamwork/activity').then(response => {
                this.activities = response.data;
            });
        },

        formatActivityText(type, action) {
            var string = type + ' ' + action;

            if (string == 'task edited') return 'Aufgabe bearbeitet';
            if (string == 'milestone edited') return 'Meilenstein bearbeitet';
            if (string == 'task completed') return 'Aufgabe erledigt';
            if (string == 'milestone completed') return 'Meilenstein erledigt';
            if (string == 'task new') return 'Aufgabe erstellt';
            if (string == 'milestone new') return 'Meilenstein erstellt';
            if (string == 'file new') return 'Datei hinzugefügt';
            if (string == 'billingInvoice new') return 'Rechnung erstellt';
            if (string == 'billingInvoice completed') return 'Rechnung erstellt';

            return string;
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
