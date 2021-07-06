
$(".form-db").on('submit', function (e) {
    e.preventDefault();
    var form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: $(form).serialize(),
        dataType: "json",
        success: function (response) {
            let history_body = $('.history-body')
            history_body.empty();
            $('.alert').remove();
            
            if (response.status == 'success') {                
                console.log("success");
                if (response.type == 'companyAdd') {
                    $(form).append("<div class='alert alert-" + response.status + "'>" + response.message + "</div>");
                } else if (response.type == 'companyExists'){
                    $(form).append("<div class='alert alert-" + response.status + "'>" + response.message + "</div>");
                } else if (response.type == 'companyUser') {
                    $(form).append("<div class='alert alert-" + response.status + "'>" + response.message + "</div>");
                } else if (response.type == 'companyLogin') {
                    $(form).append("<div class='alert alert-" + response.status + "'>" + response.message + "</div>");
                } else if (response.type == 'companyDate'){
                    console.log(response.company);
                    
                    let company = response.company;
                    
                    let i=0;
                    let j;
                    let fields = [];    //company's fields
                    let rows = [];      //company's rows
                    let table_info;     //class table-info
                    let table_light;    //class table-light
                    let table_key;      //th with key
                    /***Extract every company found***/
                    $.each(company, function(key, element){

                        table_key= '<th scope="row" class="field">'+(key+1)+'</th>';
                        table_info='<tr class="table-info table-data">';
                        table_light='<tr class="table-light table-data">';
                        
                            j=0
                            //each set of fields are in array
                            $.each(element, function(k, field){
                                fields[j] ='<td>'+field+'</td>';
                                j++;
                            })
    
                        if(i%2==0){
                            //row with color info  
                            for (let k = 0; k < fields.length; k++) {
                                table_key += fields[k];
                            }
                            table_info += table_key;
                            rows[i] = table_info;
                            
                        }else{
                            //row with color light
                            for (let k = 0; k < fields.length; k++) {
                                table_key += fields[k];
                            }
                            table_light += table_key;
                            rows[i] = table_light;
                        }
                        
                        i++;
                    })
                    //Show loading animation
                    loadingAnimation();
                    //Append each row to table body
                    setTimeout(function (){  
                        for (let i = 0; i < rows.length; i++) {
                            
                            history_body.append(rows[i]);
                        }
                    }, 700)
                    //Message to valid Date
                    if(response.warning){
                        $(form).append("<div class='alert alert-warning'>" + response.message + "</div>");    
                    }
                    
                }
            } else {
                //Data not found or alternative errors
                loadingAnimation()
                $(form).append("<div class='alert alert-" + response.status + "'>" + response.message + "</div>");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log($(form).serialize());
            console.log('' + form.attr('action'));
            //console.log(response);
            $(form).parent().addClass('alert alert-danger');
            $(form).append("<div>Status: " + textStatus + "<br/>Error: " + errorThrown + "</div>");
        }
    });
});

/*Light and Dark Mode */
let darkMode = true;
$('.btn-outline-light').on("click", function(){
    if(darkMode){
        $('body').removeClass('bg-dark text-white').addClass('bg-white text-dark')
        $('.btn-outline-light').removeClass('btn-outline-light').addClass('btn-outline-dark')
        $('.btn-outline-dark').text("Dark");
        $('.table-dark').removeClass('table-dark');
        $('.btn-outline-dark').attr('title', 'Dark Mode');
        $('.btn-outline-info').removeClass('text-white').addClass('text-dark')
        $('.inner.one').attr('style', 'border-bottom:3px solid #101006')
        $('.inner.two').attr('style', 'border-right:3px solid #101006')
        $('.inner.three').attr('style', 'border-top:3px solid #101006')
        $('.navbar').removeClass('navbar-dark bg-dark').addClass('navbar-light bg-light')
    }
    else{
        $('body').removeClass('bg-white text-dark').addClass('bg-dark text-white')
        $('.btn-outline-dark').removeClass('btn-outline-dark').addClass('btn-outline-light')
        $('.btn-outline-light').text("Light");
        $('.table').addClass('table-dark');
        $('.btn-outline-light').attr('title', 'Light Mode');
        $('.btn-outline-info').removeClass('text-dark').addClass('text-white')
        $('.inner.one').attr('style', 'border-bottom:3px solid #EFEFFA')
        $('.inner.two').attr('style', 'border-right:3px solid #EFEFFA')
        $('.inner.three').attr('style', 'border-top:3px solid #EFEFFA')
        $('.navbar').removeClass('navbar-light bg-light').addClass('navbar-dark bg-dark')
    }
    darkMode=!darkMode;
})
/*Responsive menu */
let isToggle=false
const toggler = $('.navbar-toggler');
const navbar = $('.navbar-collapse');
toggler.on('click', function(){
    if(isToggle){
        toggler.addClass('collapsed')
        toggler.attr('aria-expanded', 'false')
        navbar.addClass('collapsing')
        navbar.removeClass('collapse')
        //setTimeout(() => {
            
            navbar.addClass('collapsing')
            navbar.removeClass('collapsing')
            navbar.addClass('collapse')
            navbar.removeClass('show')
        //}, 500);
        
    }else{
        toggler.removeClass('collapsed')
        toggler.attr('aria-expanded', 'true')
        navbar.addClass('collapsing')
        navbar.removeClass('collapse')
        //setTimeout(() => {
            
            navbar.addClass('collapsing')
            navbar.removeClass('collapsing')
            navbar.addClass('collapse')
            navbar.addClass('show')
        //}, 500);
        
    }
    isToggle=!isToggle;
})
/*Change active link */
let currentFile = location.href;
if(currentFile == "https://adp.dontbrand.it/form-post.php"){
    $('#history').removeClass('active');
    $('#form').addClass('active');
}
if(currentFile == "https://adp.dontbrand.it/history_view.php"){
    $('#history').addClass('active');
    $('#form').removeClass('active');
}

/*Functions */
function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
      currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}

function loadingAnimation() {
    $('.loader').removeClass('invisible');
    setTimeout(function (){
        $('.loader').removeClass('invisible');
        $('.loader').addClass('invisible');
    }, 200)
}
    /*
        ### Response
        Create array 'response'
        header('Content-type: application/json');
        echo json_encode($response);
    */
