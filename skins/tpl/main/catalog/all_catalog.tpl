<div class="page-header">
    <div class="page-header-left">
        <h1><? echo $PAGE->getTitle();?></h1>
        <div class="breadcrumbs">
            <?php echo $lk_bread_crumbs;?>
        </div>
    </div>
    <div class="page-header-right">
        <a href="/shop/catalog/add-category" class="button">Добавить категорию</a>
    </div>
</div>
<div class="as-table-card">
    <?php echo $categories_table;?>
</div>