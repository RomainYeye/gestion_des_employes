window.onload=function() {

    loadWithInfos();

    $("#select").change(function(e){
        id = $(this).val();
        loadWithInfos();
    });
    $("#nom").keyup(function(e){
        nom = $(this).val();
        loadWithInfos();
    });
    $("#prenom").keyup(function(e){
        prenom = $(this).val();
        loadWithInfos();
    });
    $("#salmin").keyup(function(e){
        salmin = $(this).val();
        loadWithInfos();
    });
    $("#salmax").keyup(function(e){
        salmax = $(this).val();
        loadWithInfos();
    });

    function loadWithInfos() {
        $('#ptable').load("displayTable.php", {
            noserv: $('#select').val(),
            nom : $('#nom').val(),
            prenom : $('#prenom').val(),
            salmin : $('#salmin').val(),
            salmax : $('#salmax').val()
        }, function(){
            $(".btndeleteemp").click(function(e){
                e.preventDefault();
                var data = $(this).data("noemp");
                $.ajax({
                    url : 'AJAXAnswer.php?',
                    type : "post",
                    data : {"id-emp": data, "delete-emp":""},
                    success : function(data){
                        if($.trim(data)){
                            $(".error-message").html(data).show();
                        }
                        else {
                            loadWithInfos();
                        }
                    }, 
                    error : function(xhr, message, status){
                        alert("Erreur !");
                    }
                })
            })
        })
    }

    $('#form-emp').submit(function(e) {
        e.preventDefault();
        var postData = $(this).serialize();
        console.log(postData);
        $.ajax({
            url: 'AJAXAnswer.php',
            type: 'post',
            data: postData,
            success: function(data){
                console.log(data);
                if($.trim(data)) {
                    $(".error-message").html(data).show();
                }
                else {
                    window.location = "main_page.php";
                }
            },
            error: function(xhr, message, status) {
                alert("Erreur !");
            }
        })
    })

    $('#menujs').click(function(e){
        if($('#menujs').text()=="+"){
            $('#menujs').html('-');
        } else {
            $('#menujs').html('+');
        } 
        $('#formmenujs').toggle("slow", function(){
            
        });
    });

}