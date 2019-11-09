jQuery(document).ready(function () {
var DropDrownVal="";
	var datatable;
	// $('#m_form_type').one('change', function (event) {
 //       DropDrownVal = $(this).val();
 //       datatable.reload();
 //    });
      (function() {
          $('.loader_msg').css('display','none');
          var accountsdata;
          download_url = '../storage/app/documents';
          datatable = $('.m_datatable').mDatatable({
            // datasource definition
          data: {
          type: 'remote',
          source: {
              read: {
                  url: 'documents/getAllDocuments',
                  method: 'GET',
                  // custom headers
                  headers: { 'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                  params: {
                      // custom query params
                      query: {
                          generalSearch: '',
                          searchhotness: ''
                      }
                  },
                  map: function(raw) {
                  	  console.log('ITS RUN');
                  	  console.log(raw);
                      // sample data mapping
                      var dataSet = raw;
                      if (typeof raw.data !== 'undefined') {
                           dataSet = raw.data;
                      }
                      console.log('Result');
                      console.log(dataSet);
                      return dataSet;
                  },
              }
          },
          pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: false
            },

            serverPaging: false,
            serverFiltering: false,
            serverSorting: false
        },
      // layout definition
        layout: {
          theme: 'default', // datatable theme
          class: '', // custom wrapper class
          scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
          // height: 450, // datatable's body's fixed height
          footer: false // display/hide footer
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
          input: $('#generalSearch')
        },

        // inline and bactch editing(cooming soon)
        // editable: false,

        // columns definition
        columns: [{
        field: "id",
        title: "ID",
        textAlign: 'center'
      },
            {
                field: "documents_name",
                title: "Name",
                textAlign: 'center'
            },
            {
                field: "path",
                title: "Download URL",
                textAlign: 'center',
                template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                    return '\
                    <div >\
                      <a title="Download Contact" href="'+download_url+'/'+row.documents_name+'" download>Download</span></a>\
                    </div>\
                    ';
                }
            },
            {
                field: "type",
                title: "Type of Documents",
                textAlign: 'center'
            }]
      });
      $('#m_form_status, #m_form_type').selectpicker();
      $('#m_form_status').on('change', function (event) {
        var value = $(this).val();
        datatable.search(value,'Status')
        //datatable.setDataSourceQuery({searchhotness:value});
        //datatable.reload();
      });
})();
});
