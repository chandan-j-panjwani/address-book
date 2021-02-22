// document.getElementById('Toleftpage').addEventListener('click', toleft);
// document.getElementById('Toleftpage');

// $(function() {
//     $(".dropdown-trigger").dropdown();

//     $(".close-alert").click(function() {
//         $(this).parent().fadeOut(500);
//     });
// });

// class slHTTP {


//     post(url) {
//         return new Promise((resolve, reject) => {
//             fetch(url, {
//                     method: 'POST'
//                 })
//                 .then()
//                 .catch(err => reject(err));
//         });
//     }

// }

// const http = new slHTTP();

// function toleft(e) {
//     e.prevenDefault();
//     console.log(e);

//     http.post(`http: //localhost:9090/index.php?page=1`)
//         .catch(err => console.error(err));

// }
// console.log("i am a gnius")


// $(document).ready(function() {
//     $("#Toleftpage").click(function() {
//         $.post("http: //localhost:9090/index.php?page=1", {
//                 project: "test"
//             },
//             function(data) {
//                 $("#ajax").html(data);
//             });
//     });
// });

// var currentPage = 1;
// loadCurrentPage();

// $("#Toleftpage, #Torightpage").click(function() {
//     currentPage =
//         ($(this).attr('id') == 'Torightpage') ? currentPage + 1 : currentPage - 1;

//     if (currentPage == 0) //Check for min
//         currentPage = 1;
//     else if (currentPage == 101) //Check for max
//         currentPage = 100;
//     else
//         loadCurrentPage();
// });

// function loadCurrentPage() {
//     $('#Torightpage', '#Toleftpage').attr('disabled', 'disabled'); //disable buttons

//     show loading image
//     $('#displayResults').html('<img src="http://blog-well.com/wp-content/uploads/2007/06/indicator-big-2.gif" />');

//     $.ajax({
//         url: '/echo/html/',
//         data: 'html=Current Page: ' + currentPage + '&delay=1',
//         type: 'POST',
//         success: function(data) {
//             $('#Torightpage', '#Toleftpage').attr('disabled', ''); //re-enable buttons
//             $('#displayResults').html(data); //Update Div
//             console.log("stupid");
//         }
//     });
// }
class slHTTP{
    get(url){
        return new Promise((resolve, reject) => {
            fetch(url)
                .then(res => {
                    if(!res.ok)
                        throw new Error(res.status);
                    return res.json();
                })
                .then(data => resolve(data))
                .catch(err => reject(err));
        });
    }
}

const http = new slHTTP();

function fetchpage(page){
    http.get('http://localhost:9090/copyy.php?page=')
    .catch(err => console.log(err));
}
$(document).ready(function() {
    load_data();

    function load_data(page) {
        fetchpage();
        $.ajax({
            url: "copyy.php",
            method: "GET",
            data: { page: page },
            success: function(data) {
                // $('#pagination_data').html(data);
                fetchpage(page);
            }
        })
    }
    $(document).on('click', '.pagination-link', function() {
        e.preventDefault();
        var page = $(this).attr("id");
        load_data(page);
    });
});