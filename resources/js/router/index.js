import Home from '../views/Home';
import About from '../views/About';
import Contact from '../views/Contact';

// create notes
import CreateNote from '../views/notes/Create';

// table note
import TableOfNote from '../views/notes/Table';

// show note
import ShowTheNote from '../views/notes/Show';

export default {
    mode: 'history',
    linkActiveClass: 'active',
    routes: [

        {
            path: '/',
            name: 'home',
            component: Home
        },

        {
            path: '/about',
            name: 'pages.about',
            component: About
        },

        {
            path: '/contact',
            name: 'pages.contact',
            component: Contact
        },

        {
            path: '/notes/create',
            name: 'notes.create',
            component: CreateNote
        },

        {
            path: '/notes/table',
            name: 'notes.table',
            component: TableOfNote
        },

        {
            path: '/notes/:noteSlug',
            name: 'notes.show',
            component: ShowTheNote
        },

    ]
}