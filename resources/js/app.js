import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import Activity from './components/Activity';
import Board from './components/Board';
import Milestones from './components/Milestones';
import Dashboard from './components/Dashboard';
import Calendar from './components/Calendar';
import Statistics from './components/Statistics';
import InternetConnection from './components/InternetConnection';
import TeamMember from './components/TeamMember';
import TimeWeather from './components/TimeWeather';
import Trains from './components/Trains';
import Twitter from './components/Twitter';
import Uptime from './components/Uptime';
import Velo from './components/Velo';
import TileTimer from './components/TileTimer';

new Vue({
    el: '#dashboard',

    components: {
        Activity,
        Board,
        Dashboard,
        Milestones,
        Calendar,
        Statistics,
        InternetConnection,
        TeamMember,
        TimeWeather,
        Trains,
        Twitter,
        Uptime,
        Velo,
        TileTimer,
    },

    created() {
        let config = {
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
            wsHost: window.location.hostname,
            wsPath: window.dashboard.clientConnectionPath,
            wsPort: window.dashboard.wsPort,
            disableStats: true,
        };

        if (window.dashboard.environment === 'local') {
            config.wsPort = 6001;
        }

        //this.echo = new Echo(config);
    },
});
