$(document).ready(function () {

    $('#arTable').DataTable({

        "language":{
            "decimal":        "",
            "emptyTable":     "No data available in table",
            "info":           "اظهار  _START_ الي _END_ من اجمالى _TOTAL_ صف",
            "infoEmpty":      "Showing 0 to 0 of 0 entries",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "عرض  _MENU_ صفوف",
            "loadingRecords": "جاري التحميل...",
            "processing":     "جاري...",
            "search":         "بحث:",
            "zeroRecords":    "لا يوجد نتائج لهذا البحث",
            "paginate": {
                "first":      "الاول",
                "last":       "الاخير",
                "next":       "التالى",
                "previous":   "السابق"
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }



    });

});