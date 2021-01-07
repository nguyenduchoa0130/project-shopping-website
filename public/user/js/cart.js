$(document).ready(function () {
  $(".select-product").on("change", function (e) {
    if ($(this).prop("checked")) {
      let count = $("#order-detail-body tr").length;
      let card = $(this).closest(".card");
      let card_body = $(card).find(".card-body");
      let name = $(card_body).find(".name").html().trim();
      let price = Number.parseInt($(card_body).find(".price").html().slice(4));
      let quantity = $(card_body).find(".quantity").val();
      let row = `
        <tr>
            <th scope="row">${count + 1}</th>
            <td class='text-center h6'>${name}</td>
            <td class='text-center'>${quantity}</td>
            <td class='text-center'>${price}</td>
            <td class='text-center'>${price * quantity}</td>
      </tr>`;   
        $("#order-detail-body").append(row);
    } else {
    }
  });
});
