<p class="text-primary font-italic h5 mx-1">Số Lượng: </p>
<div class="input-group">
    <span class="input-group-prepend">
        <button type="button" class="btn btn-outline-danger btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
            <span class="fa fa-minus"></span>
        </button>
    </span>
    <input type="text" id="quantity" name="quant[1]" class="form-control input-number text-center font-weight-bold" value="1" min="1" max="<?php echo $product->quantity; ?>">
    <span class="input-group-append">
        <button type="button" class="btn btn-outline-success btn-number" data-type="plus" data-field="quant[1]">
            <span class="fa fa-plus"></span>
        </button>
    </span>
</div>

<!--
    TODO Chứa trong col
 -->