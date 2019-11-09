$(document).ready(function() {
    Vue.directive('select', {
        twoWay: true,
        bind: function (el, binding, vnode) {
            $(el).select2().on("select2:select", (e) => {
                // v-model looks for
                //  - an event named "change"
                //  - a value with property path "$event.target.value"
                el.dispatchEvent(new Event('change', { target: e.target }));
            });
            $(el).select2().on("select2:unselect", (e) => {
                // v-model looks for
                //  - an event named "change"
                //  - a value with property path "$event.target.value"
                el.dispatchEvent(new Event('change', { target: e.target }));
            });
        },
    });
    new Vue({
        el: '#candidates',
        data: {
            salaryExpectations: [],
            roleDefinitions: [],
            techSkills: [],
            possibleLocations: [],
            linguisticProficiencyDe: [],
            linguisticProficiencyEn: [],
            candidates: allCandidates,
        },
        mounted () {
            if( $(".img-info").height() > 23 ){
                $(this).css("bottom","-22px");
            }

            tippy('.tippy')
        },
        computed: {
            filter: function() {
                return {
                    salaryExpectations: this.salaryExpectations,
                    roleDefinitions: this.roleDefinitions,
                    techSkills: this.techSkills,
                    possibleLocations: this.possibleLocations,
                    linguisticProficiencyDe: this.linguisticProficiencyDe,
                    linguisticProficiencyEn: this.linguisticProficiencyEn
                };
            }
        },
        watch: {
            salaryExpectations: function () {
                this.applyFilter()
            },
            roleDefinitions: function () {
                this.applyFilter()
            },
            techSkills: function () {
                this.applyFilter()
            },
            possibleLocations: function () {
                this.applyFilter()
            },
            linguisticProficiencyDe: function () {
                this.applyFilter()
            },
            linguisticProficiencyEn: function () {
                this.applyFilter()
            },
        },
        methods: {
            applyFilter: function () {
                let component = this;
                this.candidates = allCandidates.filter(({raw: {hourly_rate}}) => {
                    return component.applyFilterItem(component.salaryExpectations, hourly_rate.split(','));
                }).filter(({raw: {role_definition}}) => {
                    return component.applyFilterItem(component.roleDefinitions, role_definition.split(','))
                }).filter(({raw: {category_skills}}) => {
                    return component.applyFilterItem(component.techSkills, category_skills.split(','))
                }).filter(({raw: {travelling, traveling_state, traveling_city}}) => {
                    let possibleValues = travelling.split(',');
                    possibleValues.push(traveling_state, traveling_city);
                    return component.applyFilterItem(component.possibleLocations, possibleValues);
                }).filter(({raw: {availability_per_week}}) => {
                    return component.applyFilterItem(component.linguisticProficiencyDe, availability_per_week.split(','))
                }).filter(({raw: {availability_per_week_en}}) => {
                    return component.applyFilterItem(component.linguisticProficiencyEn, availability_per_week_en.split(','))
                });
            },

            applyFilterItem: function (selectedFilter, possibleValues) {
                if (!selectedFilter.length) {
                    return true;
                }

                for (let i in possibleValues) {
                    if (selectedFilter.includes(possibleValues[i])) {
                        return true;
                    }
                }

                return false;
            }
        }
    });


    $('#m_select2_9').select2({
        placeholder: "Select an option",
        maximumSelectionLength: 20
    });
    $('#m_select2_core').select2({
        placeholder: "Select an option",
        maximumSelectionLength: 20
    });
});