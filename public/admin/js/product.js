$(document).ready(function () {
  $(document).ready(function () {
    $(".btn-change-product-image").on("click", function(event){
        let src = this.children[0].src;
        $("#img-product-main").attr("src", src);
    });   
  });
});
