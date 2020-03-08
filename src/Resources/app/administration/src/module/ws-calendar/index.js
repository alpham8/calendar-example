import deDE from './snippet/de-DE';
import enGB from './snippet/en-GB';

Shopware.Module.register('ws-calendar', {
    color: '#ff3d58',
    icon: 'default-shopping-paper-bag-product',
    title: 'Kalendar',
    description: 'Verwalte die Kalender Berechtigungen hier',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        list: {
            component: 'ws-calender-user-list',
            path: 'list'
        },
        detail: {
            component: 'ws-calendar-detail',
            path: '/detail/:id',
            meta: {
                parentPath: 'ws.calendar.list'
            }
        }
    },

    navigation: [{
        label: 'ws-calendar.general.mainMenuItemGeneral',
        color: '#ff3d58',
        path: 'ws.calender.list',
        icon: 'default-shopping-paper-bag-product',
        position: 100
    }]
});

// reod on: https://docs.shopware.com/en/shopware-platform-dev-en/getting-started/indepth-guide-bundle/administration?category=shopware-platform-dev-en/getting-started/indepth-guide-bundle
