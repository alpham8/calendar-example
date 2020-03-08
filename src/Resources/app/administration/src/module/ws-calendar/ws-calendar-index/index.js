const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
const utils = Shopware.Utils;
import template from './ws-calendar-index.twig';
import './ws-calendar-index.scss';

Component.register('ws-calendar-index', {
    template,
    inject: ['repositoryFactory'],
    mixins: [
        Mixin.getByName('listing'),
    ],

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    data() {
        return {
            page: 1,
            limit: 25,
            total: 0,
            repository: null,
            items: null,
            isLoading: true,
            filter: {
                customerId: null
            }
        }
    },

    computed: {
        columns() {
            return [
                {
                    property: 'firstName',
                    dataIndex: 'firstName',
                    label: 'ws-calendar.list.columns.firstName',
                    allowResize: true,
                },
                {
                    property: 'lastName',
                    dataIndex: 'lastName',
                    label: 'ws-calendar.list.columns.lastName',
                    allowResize: true,
                    primary: true
                },
                {
                    property: 'email',
                    dataIndex: 'email',
                    label: 'ws-calendar.list.columns.email',
                    allowResize: true,
                    routerLink: 'ws.calendar.detail'
                },
                {
                    property: 'groupName',
                    dataIndex: 'groupName',
                    label: 'ws-calendar.list.columns.groupName',
                    allowResize: true
                }
            ]
        },
        wsCalendarRepository() {
            return this.repositoryFactory.create('ws_calendar_user_group');
        }
    },

    methods: {
        getList() {
            this.isLoading = true;

            let criteria = new Criteria();
            criteria.addAssociation('customer');
            criteria.addAssociation('ws_calendar_groups');

            if (this.filter.customerId) {
                criteria.addFilter(Criteria.equals('customerId', this.filter.customerId));
            }

            return this.wsCalendarRepository.search(criteria, Shopware.Context.api)
                .then((searchResult) => {
                    this.items = searchResult;
                    this.total = searchResult.total;
                    this.isLoading = false;
                });
        },

        resetFilter() {
            this.filter = {
                customerId: null
            };

            this.getList();
        }
    },

    watch: {
        filter: {
            deep: true,
            handler: utils.debounce(function () {
                this.getList();
            }, 400)
        }
    }
});
