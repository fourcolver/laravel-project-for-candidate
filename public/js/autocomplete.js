//== Class definition
var Typeahead = function() {

    var states1 = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
            'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
            'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
            'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
            'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
            'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
            'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
            'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
            'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
        ];
        /*var states = '';
        $.ajax({
                url: 'freelancers/getAllSkills',
                async:false,
                    success: function(response) { 
                        // similate 2s delay
                        //setTimeout(function() {
                            states = response;
                            // console.log(states);
                           // }, 2000);
                    }});
        console.log('INN');
        console.log(states);
        states1 = [{"skill":"angular"},{"skill":"ASP.Net"},{"skill":"BizTalk"},{"skill":"C #"},{"skill":"HTML"},{"skill":"jQuery"},{"skill":"knockout"},{"skill":"MVC"},{"skill":"MVVM"},{"skill":"Oracle"},{"skill":"SharePoint"},{"skill":"SQL"},{"skill":"test tech"},{"skill":"Typescript"},{"skill":"VB.Net"},{"skill":"VBA"},{"skill":"WCF"},{"skill":"WF"},{"skill":"WPF"},{"skill":"autosar"},{"skill":"C"},{"skill":"C ++"},{"skill":"Embedded"},{"skill":"firmware"},{"skill":"FPGA"},{"skill":"labview"},{"skill":"Matlab"},{"skill":"microcontrollers"},{"skill":"QT"},{"skill":"S7"},{"skill":"ajax"},{"skill":"Android"},{"skill":"Apache"},{"skill":"Cobol"},{"skill":"Delphi"},{"skill":"Django"},{"skill":"Drupal"},{"skill":"Eclipse"},{"skill":"Flash"},{"skill":"GlassFish"},{"skill":"Groovy"},{"skill":"Hibernate"},{"skill":"hubris"},{"skill":"J2EE"},{"skill":"Java"},{"skill":"JavaScript"},{"skill":"JBoss"},{"skill":"Jenkins"},{"skill":"Joomla"},{"skill":"JSF"},{"skill":"junit"},{"skill":"Magento"},{"skill":"Maven"},{"skill":"MySQL"},{"skill":"Netbeans"},{"skill":"NoSQL"},{"skill":"Oracle"},{"skill":"Perl"},{"skill":"PHP"},{"skill":"python"},{"skill":"Ruby on rails"},{"skill":"SQL"},{"skill":"SWING"},{"skill":"symfony"},{"skill":"Tomcat"},{"skill":"TYPO3"},{"skill":"Vaadin"},{"skill":"Websphere"},{"skill":"WordPress"},{"skill":"Active Directory"},{"skill":"Cisco"},{"skill":"Citrix"},{"skill":"Cognos"},{"skill":"Helpdesk"},{"skill":"Helpdesk"},{"skill":"HP"},{"skill":"Linux"},{"skill":"lotus"},{"skill":"Network"},{"skill":"NSI"},{"skill":"Oracle"},{"skill":"SAS"},{"skill":"SQL"},{"skill":"Unix"},{"skill":"VMWare"},{"skill":"Windows"},{"skill":"ABAP"},{"skill":"Admin"},{"skill":"BASE"},{"skill":"BI"},{"skill":"BW"},{"skill":"Change Management"},{"skill":"CO"},{"skill":"CRM"},{"skill":"FI"},{"skill":"HCM"},{"skill":"MR"},{"skill":"ISU"},{"skill":"MM"},{"skill":"NETWEAVER"},{"skill":"PM"},{"skill":"PP"},{"skill":"QM"},{"skill":"SD"},{"skill":"WM"},{"skill":"Automated Tester"},{"skill":"Embedded Tester"},{"skill":"Functional Tester"},{"skill":"ISTQB"},{"skill":"Performance Engineering"},{"skill":"Quality Engineer"},{"skill":"Safety test"},{"skill":"Selenium"},{"skill":"Test Analyst"},{"skill":"Test Manager"},{"skill":"tester"},{"skill":"Testing"},{"skill":"BI"},{"skill":"BI EE"},{"skill":"Cognos"},{"skill":"Crystal Reports"},{"skill":"Data Warehouse"},{"skill":"ETL"},{"skill":"MS Analysis Services"},{"skill":"MS BI"},{"skill":"Oracle BI"},{"skill":"Oracle WH Builder"},{"skill":"TM1"},{"skill":"Product Owner"},{"skill":"Project Manager"},{"skill":"SCRUM Master"}];*/
    var states1 = [
    { value: 'one', data: 'two', raw: { value: 'one' } },
    { value: 'two', data: 'two3', raw: { value: 'one' } },
    { value: 'html', data: 'two4', raw: { value: 'one' } }
  ];
    //var states = [{'name':'info'},{'name':'info'},{'name':'info'},{'name':'info'}];

    //== Private functions
    var bestPictures = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: 'freelancers/getAllSkills',
      remote: {
        url: 'freelancers/getAllSkills?query=%QUERY',
        filter: function(x) {
            return $.map(x, function(item) {
                return {value: item.skill,id:item.competences_id};
            });
        },
        wildcard: '%QUERY'
      }
    });
    console.log('INN');
    console.log(bestPictures);
    var demo1 = function() {
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };

        $('#m_typeahead_11, #m_typeahead_1_modal, #m_typeahead_1_validate, #m_typeahead_2_validate, #m_typeahead_3_validate').typeahead({
            hint: true,
            highlight: true,
            minLength: 1,

        }, {
            name: 'id',
            display: 'value',
            source: bestPictures,
             limit: 130,
            //source: substringMatcher(bestPictures),
            templates: {
                empty: [
                  '<div class="empty-message">',
                    'unable to find any skills that find current search',
                  '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<div class="value" data-id="{{id}}">{{value}}</div>'),
              }
        });
    }
    return {
        // public functions
        init: function() {
            demo1();
        }
    };
}();

jQuery(document).ready(function() {
    Typeahead.init();
});