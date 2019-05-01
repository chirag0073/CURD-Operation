<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.crestinfosystems.com/
 * @since      1.0.0
 *
 * @package    Crud_Operation
 * @subpackage Crud_Operation/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
	global $wpdb;
    $table_name = $wpdb->prefix . 'custom_email';

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit'] == 'Insert') {
	    $useremail = htmlspecialchars(stripslashes(trim($_POST['useremail'])));
	    $success = $wpdb->insert($table_name, array(
		   "email" => $useremail,
		));
		if($success) {
			echo '<div id="message" class="notice notice-success is-dismissible">Data inserted successfully!</div>';
		} else {
		   $message = 'There might be some issue with the server!';

			echo '<div id="message" class="notice notice-error is-dismissible">There might be some issue with the server!</div>';
		}
	}
?>

<h1>Personal information:</h1>
<form method="post">
	<strong> Email Address:</strong>
	<input type="email" name="useremail" id="useremail" required="" size="60"><br><br>
	<input class="btn" type="submit" value="Insert" name="submit">
</form>


<?php $users = $wpdb->get_results( "SELECT * FROM $table_name" ); ?>	
		<h2>View Records</h2>
		<table width="100%" border="1" style="border-collapse:collapse;">
			<thead>
				<tr>
					<th><strong>S.No</strong></th>
					<th><strong>Email</strong></th>
					<th><strong>Edit</strong></th>
					<th><strong>Delete</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count=1;
				if (!empty($users)) {
					foreach ($users as $user) { //print_r($user->id); ?>
					<tr>
						<td align="center"><?php echo $count; ?></td>
						<td align="center" class="crud-email<?php echo $user->id; ?>"><?php echo $user->email; ?></td>
						<td align="center">
							<a href="#" class="edit-record" data-id="<?php echo $user->id; ?>">Edit</a>
						</td>
						<td align="center" >
							<a href="#" class="delete-record" data-id="<?php echo $user->id; ?>">Delete</a>
						</td>
					</tr>
					<?php $count++; }
				} else { ?>
					<tr><td class="no-record" colspan="4"><?php echo "No records found!"; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>