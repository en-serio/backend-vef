
import '../css/styles.css';
import '../css/sidebars.css';
import '../css/app.css';
import '../images/Bootstrap-logo.png';

import 'fullcalendar';
import 'fullcalendar/dist/fullcalendar.css';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

// Importar CSS de FullCalendar y Bootstrap5
import '@fullcalendar/bootstrap5/index.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';



// Imágenes
import.meta.glob([
    '../images/**',
]);


import $ from 'jquery';
window.$ = window.jQuery = $;

import './login.js';
import './appConfig.js';
import './dashboard.js';
import './hotel.js';
import './perfil.js';
import './precios.js';
import './register.js';
import './sidebars.js';

