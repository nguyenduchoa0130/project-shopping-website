$(document).ready(function(){
    $("#infoProduct").on("show.bs.modal", function (e) {
        var id1 = $(e.relatedTarget).data("id");
        var id2 = $(e.relatedTarget).data("idcategory");
        var category = $(e.relatedTarget).data("ncategory");
        $.ajax({
            type : "post",
            url : "/project-shopping-website/admin/modules/category/load-info-product.php", //Here you will fetch records 
            data :  {id_product : id1, id_category: id2, name_category : category},
            success : function(data){
            $(".modal-body-info").html(data);//Show fetched data from database
            }  
        });
     });   
}); 