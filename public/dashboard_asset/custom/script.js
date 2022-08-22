function remove(content) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url: content,
                success: function(response) {
                    if (response == 1) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                        ).then((result1) => {
                            if (result1.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Failed!',
                            'Somthing Wrong',
                        );
                    }
                }
            });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
            )
        }
    });
}

function UpdatePreview() {
    $("#thumbnail_text").removeClass('d-none');
    $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
};

$(document).ready(function() {
    $('#frame').dblclick(() => {
        $('#thumbnail').val('');
        $('#frame').attr('src', '');
        $("#avatar").val('');
        $("#thumbnail_text").addClass('d-none');
    });
});

// $(document).ready(function() {

//     const primary = '#6993FF';
//     const success = '#1BC5BD';
//     var options = {
//         series: [],
//         chart: {
//             type: 'bar',
//             height: 350
//         },
//         plotOptions: {
//             bar: {
//                 horizontal: false,
//                 columnWidth: '50px',
//                 endingShape: 'rounded'
//             },
//         },
//         dataLabels: {
//             enabled: false
//         },
//         stroke: {
//             show: true,
//             width: 2,
//             colors: ['transparent']
//         },
//         title: {
//             text: '',
//             offsetY: 40,
//             offsetX: 0,
//             align: 'left',
//             style: {
//                 fontSize: '24px',
//                 fontWeight: 'light'
//             }
//         },
//         subtitle: {
//             text: '',
//             offsetY: 40,
//             offsetX: 0,
//             align: 'right',
//             style: {
//                 fontSize: '20px',
//                 fontWeight: 'bolder'
//             }
//         },
//         tooltip: {
//             enabled: true,
//         },
//         fill: {
//             opacity: 1
//         },
//         colors: [primary, success]


//     };

//     $.ajax({
//         type: "GET",
//         url: 'dashboard/fetch/orders',
//         dataType: "json",
//         success: function(response) {
//             // console.log(response.boosterOrders);
//             // console.log(response.coachingOrders);
//             ordersChart.updateOptions({
//                 series: [{
//                     name: 'Booster Orders',
//                     data: response.boosterOrders
//                 }, {
//                     name: 'Coaching Orders',
//                     data: response.coachingOrders
//                 }, ],
//                 xaxis: {
//                     title: {
//                         text: 'Months',
//                     },
//                     categories: response.date,
//                 },
//                 yaxis: {
//                     title: {
//                         text: 'No Of Customers'
//                     }
//                 },
//                 // title: {
//                 //     text: 'Total Customers'
//                 // },
//                 // subtitle: {
//                 //     text: response.totalCustomers,
//                 // },

//             });
//         }
//     });
//     var ordersChart = new ApexCharts(document.querySelector("#ordersChart"), options);
//     ordersChart.render();
// });

// limiting the number of selections
// $('#kt_select2_3').select2({
//     placeholder: "Select an option",
// });