const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;
import template from './ws-calendar-detail.twig';
import './ws-calendar-detail.scss';

Component.register('ws-calendar-detail', {
    template,
    inject: ['repositoryFactory'],

    data() {
        return {
            customer: null,
            isLoading: false,
            isSuccessful: false,
            calendarGroups: null,
        }
    },

    created() {
        this.syncService = Shopware.Service('syncService');
        this.httpClient = this.syncService.httpClient;
        this.repository = this.repositoryFactory.create('ws_calendar');
        this.repository.get(this.$route.params.id, Shopware.Context.api).then(customer => {
            this.customer = customer;
        });
        this.calendarGroupsRepo = this.repositoryFactory.create('ws_calendar_groups');
        this.calendarGroupsRepo.get(null, Shopware.Context.api).then(calendarGroups => {
            this.calendarGroups = calendarGroups;
        });
    },

    methods: {
        openCustomer() {
            this.$router.push({
                name: 'sw.customer.detail',
                params: { id: this.customer.customerId }
            });
        },
        getCustomer() {
            this.repository
                .get(this.$route.params.id, Shopware.Context.api)
                .then(entity => {
                    this.customer = entity;
                });
        },
        onSaveClicked() {
            this.isLoading = true;
            this.repository
                .save(this.customer, Shopware.Context.api)
                .then(() => {
                    this.getCustomer();
                    this.isLoading = false;
                    this.processSuccess = true
                }).catch((exception) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: this.$tc('ws-calendar.detail.error.errorTitle'),
                    message: exception
                });
            });
        },
        saveFinish() {
            this.processSuccess = false;
        }
    }
});
