<?php

    if(($_SESSION["profile"] == 'Seller')) {
        echo '
            <script>
                window.location="home"
            </script>
            ';
        return;
    }
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage categories
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategory">
                    Add Category
                </button>
                <!--Add category modal-->
                <div id="modalAddCategory" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <form action="" role="form" method="post" autocomplete="off">

                                <div class="modal-header bg-primary">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Category</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-tags"></i></span>
                                                <input type="text" class="form-control" name="category_name" placeholder="Enter category name" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                    <button type="submit" name="add_category" class="btn btn-primary">Save</button>
                                </div>

                                <?php
                                $createCategory = new CategoryController();
                                $createCategory->ctrlCreateCategory();
                                ?>

                            </form>
                        </div>

                    </div>
                </div>

            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped _tables">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $item = null;
                        $value = null;
                        $categories = CategoryController::ctrShowCategories($item, $value);

                        foreach ($categories as $key => $value) {
                            $id = $value["id"];
                            $name = $value["name"];

                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td class="text-uppercase"><?php echo $name; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditCategory" categoryId="<?php echo $id?>" data-toggle="modal" data-target="#modalEditCategory" ><i class="fa fa-pencil"></i></button>

                                    <?php if(($_SESSION["profile"] == 'Administrator')): ?>

                                        <button class="btn btn-danger btnDeleteCategory" categoryId="<?php echo $id?>"><i class="fa fa-times"></i></button>

                                    <?php endif;?>
                                </div>

                                <?php // executes delete category method
                                $deleteCategory = new CategoryController();
                                $deleteCategory->ctrlDeleteCategory();
                                ?>

                            </td>

                        </tr>
                        <?php  } ?>


                        <!--Edit category modal-->
                        <div id="modalEditCategory" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <form action="" role="form" method="post" autocomplete="off">

                                        <div class="modal-header bg-primary">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit Category</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-tags"></i></span>
                                                        <input type="text" class="form-control" name="e_category_name" id="e_category_name" placeholder="Enter category name" required>
                                                        <input type="hidden" class="form-control" name="e_category_id" id="e_category_id">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                            <button type="submit" name="edit_category" class="btn btn-primary">Save</button>
                                        </div>

                                        <?php
                                        $editCategory = new CategoryController();
                                        $editCategory->ctrlEditCategory();
                                        ?>

                                    </form>
                                </div>

                            </div>
                        </div>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>



