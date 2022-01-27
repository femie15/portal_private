<x-ux::layouts.page :title="__('add student')">
    <x-slot name="body">
	<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >	
            		<i class="entypo-plus-circled"></i>
                    {{ '\App\Components\Student_add'::get_phrase('addmission_form'); }}
            	</div>
            </div>
<br>

			<div class="panel-body">				
                <?php
					 //echo form_open(base_url() . 'index.php?admin/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	<form action="" method="post" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data">
					<div class="form-group">
						{{-- <label for="field-1" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('name'); }}</label> --}}
                        
						<div class="col-sm-5">							
							<x-ux::input :label="__('Name')" model="name"/>
							{{-- <input type="text" class="form-control" name="name" data-validate="required" data-message-required="{{ '\App\Components\Student_add'::get_phrase('value_required'); }}" value="" autofocus> --}}
						</div>
					</div>

					<div class="form-group">
						{{-- <label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('parent'); }}</label> --}}
                        
						<div class="col-sm-5">
							<x-ux::select :label="__('Gender')" :options="['male' => 'Male','female' => 'Female',]" model="sex" class="form-control select2"/>

							{{-- <select name="parent_id" class="form-control select2">
                              <option value="">{{ '\App\Components\Student_add'::get_phrase('select'); }}</option>
                              <?php 
								// $parents = $this->db->get('parent')->result_array();
								// foreach($parents as $row):
									?>
                            		<option value="<?php //echo $row['parent_id'];?>">
										<?php //echo $row['name'];?>
                                    </option>
                                <?php
								// endforeach;
							  ?>
                          </select> --}}
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class=" control-label">{{ '\App\Components\Student_add'::get_phrase('class'); }}</label>
                       <div class="col-sm-5">
							{{-- <x-ux::select :label="__('Class')" :options="['1'=>'j']" model="class_id" class="form-control"/> --}}


							
<select id="car" onchange="ChangeCarList()"> 
	<option value="">-- Car --</option> 
	<option value="1">Volvo</option> 
	<option value="2">Volkswagen</option> 
	<option value="3">BMW</option> 
  </select> 
  
  <select id="carmodel"></select> 
  {{-- {{ json_encode('\App\Components\Student_add'::get_class_section(1))[0] }} --}}
							<select name="class_id" model="class_id" class="form-control col-sm-5" data-validate="required" id="class_id"
								data-message-required="{{ '\App\Components\Student_add'::get_phrase('value_required'); }}" onchange="get_class_sections(this);">

                              <option value="">{{ '\App\Components\Student_add'::get_phrase('select'); }}</option>
								@foreach($classes as $row)
                            		<option value="{{ $row->class_id }}">{{ $row->name }}</option>
                                @endforeach
                          </select> 
						</div> 
					</div>

					<div class="form-group">
						{{-- <label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('section'); }}</label> --}}
		                    <div class="col-sm-5">
								{{-- <x-ux::select :label="__('Section')" :options="['1' => 'A','2' => 'B',]" model="section_id" class="form-control"/> --}}

		                        <select name="section_id" class="form-control" id="section_selector_holder">
		                            <option value="">{{ '\App\Components\Student_add'::get_phrase('select_class_first'); }}</option>	                        
			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						{{-- <label for="field-2" class="col-sm-3 control-label">Admission No</label> --}}
                        
						<div class="col-sm-5">
							<x-ux::input :label="__('Admission No')" model="roll" class="form-control"/>

							{{-- <input type="text" class="form-control" name="roll" value="" > --}}
						</div> 
					</div>
					
					<div class="form-group">
						{{-- <label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('birthday'); }}</label> --}}
                        
						<div class="col-sm-5">							
							<x-ux::input :label="__('Date of Birth')" model="birthday" class="form-control datepicker"  data-start-view="2"/>
							{{-- <input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2"> --}}
						</div> 
					</div>
					
					{{-- <div class="form-group"> --}}
						{{-- <label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('gender'); }}</label> --}}
                        
						{{-- <div class="col-sm-5"> --}}
							{{-- <x-ux::select :label="__('Gender')" :options="['male'=>'Male', 'female'=>'Female']" model="sex"  class="form-control"/> --}}


							{{-- <select name="sex" class="form-control selectboxit">
                              <option value="">{{ '\App\Components\Student_add'::get_phrase('select'); }}</option>
                              <option value="male">{{ '\App\Components\Student_add'::get_phrase('male'); }}</option>
                              <option value="female">{{ '\App\Components\Student_add'::get_phrase('female'); }}</option>
                          </select> --}}
						{{-- </div> 
					</div> --}}
					
					<div class="form-group">
						{{-- <label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('address'); }}</label> --}}
                        
						<div class="col-sm-5">
							<x-ux::input :label="__('Address')" model="address" class="form-control"/>
							{{-- <input type="text" class="form-control" name="address" value="" > --}}
						</div> 
					</div>
					
					<div class="form-group">
						{{-- <label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('phone'); }}</label> --}}
                        
						<div class="col-sm-5">
							<x-ux::input :label="__('Phone')" type="number" model="phone" class="form-control"/>
							
							{{-- <input type="text" class="form-control" name="phone" value="" > --}}
						</div> 
					</div>
                    
					<div class="form-group">
						{{-- <label for="field-1" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('email'); }}</label> --}}
						<div class="col-sm-5">
							<x-ux::input :label="__('Email')" type="email" class="form-control" model="email"/>

							{{-- <input type="text" class="form-control" name="email" value=""> --}}
						</div>
					</div>
					
					<div class="form-group">
						{{-- <label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('password'); }}</label> --}}
                        
						<div class="col-sm-5">
							<x-ux::input :label="__('Password')" type="password" class="form-control" model="password"/>

							{{-- <input type="password" class="form-control" name="password" value="" > --}}
						</div> 
					</div>

					
					{{-- <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Last School Attended</label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="house" value="" >
						</div> 
					</div> --}}
					
					{{-- <div class="form-group" hidden>
						<label for="field-2" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('dormitory'); }}</label>
                        
						<div class="col-sm-5">
							<select name="dormitory_id" class="form-control selectboxit">
							<option value="0" selected>0</option>
                              <option value="">{{ '\App\Components\Student_add'::get_phrase('select'); }}</option>
	                              <?php 
	                              	// $dormitories = $this->db->get('dormitory')->result_array();
	                              	// foreach($dormitories as $row):
	                              ?>
                              		<option value="<?php //echo $row['dormitory_id'];?>"><?php //echo $row['name'];?></option>
                              		
                          		<?php //endforeach;?>
                          </select>
						</div> 
					</div> --}}

										
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">{{ '\App\Components\Student_add'::get_phrase('photo'); }}</label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">{{ '\App\Components\Student_add'::get_phrase('add_student'); }}</button>
						</div>
					</div>
	</form>
                <?php //echo form_close();?>
            </div>
        </div>
    </div>
</div>
</x-ux::layouts.page>

<script type="text/javascript">

	function get_class_sections(class_ids) {
		var cv=class_ids.value;
		// alert(cv);
		// document.getElementById("section_selector_holder").option={{ '\App\Components\Student_add'::get_class_section(1); }};
		
		var x = document.getElementById("section_selector_holder");
  var c = document.createElement("option");
  c.text = "Kiwi";
  x.options.add(c, 1);

		// $.ajax({
		//     url: {{ '\App\Components\Student_add'::get_class_section(1) }} ,
		//     success: function(response)
		//     {
		//         // jQuery('#section_selector_holder').html(response);
		// 		alert(response);
		//     }
		// });
		// jQuery('#section_selector_holder').html({{ '\App\Components\Student_add'::get_class_section(1) }});

	}


  var carsAndModels = {};
  carsAndModels['1'] = ['M6', 'X5', 'Z3'];

  carsAndModels['2'] = ['Golf', 'Polo', 'Scirocco', 'Touareg'];
  carsAndModels['3'] = ['M6', 'X5', 'Z3'];
  
  function ChangeCarList() {
	var carList = document.getElementById("car");
	var modelList = document.getElementById("carmodel");
	var selCar = carList.options[carList.selectedIndex].value;
	while (modelList.options.length) {
	  modelList.remove(0);
	}
	var cars = carsAndModels[selCar];
	if (cars) {
	  var i;
	  for (i = 0; i < cars.length; i++) {
		var car = new Option(cars[i], i);
		modelList.options.add(car);
	  }
	}
  } 
  </script>