<!-- skins/tpl/form/pages/add_page.tpl begin -->

    <form id="AddProductForm" action="javascript:void(null);" onSubmit="tinyMCE.triggerSave(false,false); xajax_Add_Product(xajax.getFormValues('AddProductForm'));"> 
        <?php include AS_ROOT.'skins/tpl/form/products/product_pattern.tpl';  ?>
    </form>