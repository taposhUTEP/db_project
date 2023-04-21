<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Costumers class
require_once BASE_PATH . '/lib/Costumers/Costumers.php';
$costumers = new Costumers();

// Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

// Per page limit for pagination.
$pagelimit = 15;

// Get current page.
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// If filter types are not selected we show latest added data first
if (!$filter_col) {
	$filter_col = 'PLcode';
}
if (!$order_by) {
	$order_by = 'Desc';
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('PLcode', 'PLtype', 'PLgate', 'PLmin_clean_time', 'PLmax_clean_time', 'PLairport_code', 
                'SERservice_number', 'SERduration', 'SERdate', 'Tcode');

//Start building query according to input parameters.
// If search string
if ($search_string) {
	$db->where('PEfname', '%' . $search_string . '%', 'like');
	$db->orwhere('PElname', '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by) {
	$db->orderBy($filter_col, $order_by);
}

// Set pagination limit
$db->pageLimit = $pagelimit;

// Get result of the query.
$rows = $db->arraybuilder()->paginate('plane', $page, $select);
$total_pages = $db->totalPages;

include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Planes</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_customer.php?operation=create" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add new</a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

    <!-- Filters -->
        <!-- Removed Filters -->
    <!-- //Filters -->

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="10%">Plane Code</th>
                <th width="5%">Type</th>
                <th width="5%">Gate</th>
                <th width="10%">Min Cl. Time</th>
                <th width="10%">Max Cl. Time</th>
                <th width="10%">Airport Code</th>
                <th width="10%">Ser. Num</th>
                <th width="10%">Ser. Duration</th>
                <th width="10%">Ser. Date</th>
                <th width="10%">Terminal</th>
                <th width="10%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['PLcode']; ?></td>
                <td><?php echo xss_clean($row['PLtype']); ?></td>
                <td><?php echo xss_clean($row['PLgate']); ?></td>
                <td><?php echo xss_clean($row['PLmin_clean_time']); ?></td>
                <td><?php echo xss_clean($row['PLmax_clean_time']); ?></td>
                <td><?php echo xss_clean($row['PLairport_code']); ?></td>
                <td><?php echo xss_clean($row['SERservice_number']); ?></td>
                <td><?php echo xss_clean($row['SERduration']); ?></td>
                <td><?php echo xss_clean($row['SERdate']); ?></td>
                <td><?php echo xss_clean($row['Tcode']); ?></td>
                <td>
                    <a href="edit_customer.php?customer_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['PLcode']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['PLcode']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_plane.php" method="POST">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Confirm</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['PLcode']; ?>">
                                <p>Are you sure you want to delete this row?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default pull-left">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- //Delete Confirmation Modal -->
            <?php endforeach;?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'planes.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
