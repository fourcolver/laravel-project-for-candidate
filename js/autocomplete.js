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
                    return { value: item.skill, id: item.competences_id };
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