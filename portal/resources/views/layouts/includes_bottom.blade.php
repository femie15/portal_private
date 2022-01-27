
	<link rel="stylesheet" href="../assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="../assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="../assets/js/select2/select2.css">
	<link rel="stylesheet" href="../assets/js/selectboxit/jquery.selectBoxIt.css">

   	<!-- Bottom Scripts -->
	<script src="../assets/js/gsap/main-gsap.js"></script>
	<script src="../assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	<script src="../assets/js/joinable.js"></script>
	<script src="../assets/js/resizeable.js"></script>
	<script src="../assets/js/neon-api.js"></script>
	<script src="../assets/js/toastr.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
	<script src="../assets/js/fullcalendar/fullcalendar.min.js"></script>
    <script src="../assets/js/bootstrap-datepicker.js"></script>
    <script src="../assets/js/fileinput.js"></script>
    
    <script src="../assets/js/jquery.dataTables.min.js"></script>
	<script src="../assets/js/datatables/TableTools.min.js"></script>
	<script src="../assets/js/dataTables.bootstrap.js"></script>
	<script src="../assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="../assets/js/datatables/lodash.min.js"></script>
	<script src="../assets/js/datatables/responsive/js/datatables.responsive.js"></script>
    <script src="../assets/js/select2/select2.min.js"></script>
    <script src="../assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>

    
	<script src="../assets/js/neon-calendar.js"></script>
	<script src="../assets/js/neon-chat.js"></script>
	<script src="../assets/js/neon-custom.js"></script>
	<script src="../assets/js/neon-demo.js"></script>
	<script src="../assets/js/switch.js"></script>


<!-- SHOW TOASTR NOTIFICATION -->
{{-- <?php if (1==1):?>

<script type="text/javascript">
	toastr.success('SUCCESSFUL');
</script>

<?php endif;?> --}}

<script>
	function scrollDown() {
		document.getElementById('chata').scrollTop =  document.getElementById('chata').scrollHeight
	}
	// setInterval(scrollDown, 1000);
    function clr() {    
    document.getElementById("message").value="";
	var form = document.getElementByName("ket");
form.reset();
    }
</script>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{	

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});

		$("input[data-bootstrap-switch]").each(function(){
  $(this).bootstrapSwitch('state', $(this).prop('checked'));
})

	});	
	
</script>
