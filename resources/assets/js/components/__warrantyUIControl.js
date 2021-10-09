
var CategoryCodeByID = "";
var BrandCodeByID = "";

function Nyoba(Param1,Param2){


    if(Param2 == "brand"){
        BrandCodeByID = $(Param1);
    }
    else{
        CategoryCodeByID = $(Param1);
    }

    // console.log(CategoryCodeByID.val());
    // console.log(BrandCodeByID.val());

    if(CategoryCodeByID != "" && BrandCodeByID !=  ""){

    // var data = { value : value };
    // /transaction/getmodel/{catid}/{brandid}'
    var request = $.ajax({
        url: "search/getmodel",
        method: 'get',
        data: {
           CategoryCode: CategoryCodeByID.val(),
           BrandCode: BrandCodeByID.val(),
        }
    });
    request.done(function(msg) {
        // console.log( msg );
        var msgJSON = JSON.parse(msg);

        $('#model-code').empty();

        $.each(msgJSON, function (bb) {
            // console.log (bb);
            // console.log (msgJSON[bb]);
            // console.log (msgJSON[bb].tblitemmodel_id);
            // console.log (msgJSON[bb].tblitemmodel_codeModel);
            // console.log (msgJSON[bb].tblitemmodel_descriptionModel);

            $('#model-code').append($('<option>', {
                value: msgJSON[bb].tblitemmodel_id,
                text : msgJSON[bb].tblitemmodel_codeModel + " - " + msgJSON[bb].tblitemmodel_descriptionModel
            }));
        });
      });

      request.fail(function(jqXHR, textStatus) {
        console.log( "Request failed: " + textStatus );
        alert("Request failed");
      });

    }
}


function NyobaEdit(Param1,Param2){


    if(Param2 == "brand"){
        BrandCodeByID = $(Param1);
    }
    else{
        CategoryCodeByID = $(Param1);
    }

    // console.log(CategoryCodeByID.val());
    // console.log(BrandCodeByID.val());

    if(CategoryCodeByID != "" && BrandCodeByID !=  ""){

    // var data = { value : value };
    // /transaction/getmodel/{catid}/{brandid}'
    var request = $.ajax({
        url: "search/getmodel",
        method: 'get',
        data: {
           CategoryCode: CategoryCodeByID.val(),
           BrandCode: BrandCodeByID.val(),
        }
    });
    request.done(function(msg) {
        // console.log( msg );
        var msgJSON = JSON.parse(msg);

        $('#model-code-edit').empty();

        $.each(msgJSON, function (bb) {
            // console.log (bb);
            // console.log (msgJSON[bb]);
            // console.log (msgJSON[bb].tblitemmodel_id);
            // console.log (msgJSON[bb].tblitemmodel_codeModel);
            // console.log (msgJSON[bb].tblitemmodel_descriptionModel);

            $('#model-code-edit').append($('<option>', {
                value: msgJSON[bb].tblitemmodel_id,
                text : msgJSON[bb].tblitemmodel_codeModel + " - " + msgJSON[bb].tblitemmodel_descriptionModel
            }));
        });
      });

      request.fail(function(jqXHR, textStatus) {
        console.log( "Request failed: " + textStatus );
        alert("Request failed");
      });

    }
}

window.onload = function() {
    if (window.$.ajax) {
        // jQuery is loaded
        alert("Yeah!");
    } else {
        // jQuery is not loaded
        alert("Doesn't Work");
    }
}


function test(){
    console.log("Anjay");
}
